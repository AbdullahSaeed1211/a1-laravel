function normalizePrefix(prefix) {
  if (!prefix) return '/blog'
  return prefix.startsWith('/') ? prefix.replace(/\/$/, '') : `/${prefix.replace(/\/$/, '')}`
}

function normalizeBasePath(basePath) {
  if (!basePath || basePath === '/') return ''
  const trimmed = basePath.replace(/^\/+|\/+$/g, '')
  return trimmed ? `/${trimmed}` : ''
}

function normalizePath(path, fallback = '/') {
  if (!path) return fallback
  const withLeadingSlash = path.startsWith('/') ? path : `/${path}`
  const normalized = withLeadingSlash.replace(/\/+$/, '')
  return normalized || '/'
}

function joinPaths(basePath, path) {
  const base = normalizeBasePath(basePath)
  const suffix = path.startsWith('/') ? path : `/${path}`
  return base ? `${base}${suffix}` : suffix
}

function mapBlogPath(pathname, blogPrefix, upstreamHomePath) {
  const rest = pathname.replace(new RegExp(`^${blogPrefix}/?`), '')

  if (!rest) {
    return upstreamHomePath
  }

  const trimmed = rest.replace(/^\/+/, '')

  const homeScopedPrefixes = ['category/', 'tag/', 'author/', 'search']
  const rootScopedPrefixes = ['post/', 'rss', 'sitemap']

  if (homeScopedPrefixes.some((prefix) => trimmed.startsWith(prefix))) {
    if (upstreamHomePath === '/') {
      return `/${trimmed}`
    }
    return `${upstreamHomePath}/${trimmed}`
  }

  const shouldPassThrough =
    rootScopedPrefixes.some((prefix) => trimmed.startsWith(prefix)) ||
    trimmed.includes('.') ||
    trimmed.includes('/')

  if (shouldPassThrough) {
    return `/${trimmed}`
  }

  if (trimmed === 'post') {
    return '/post'
  }

  return `/post/${trimmed}`
}

function toPublicBlogPath(upstreamPath, upstreamBasePath, blogPrefix, upstreamHomePath) {
  const basePath = normalizeBasePath(upstreamBasePath)
  const normalizedPrefix = normalizePrefix(blogPrefix)
  const normalizedHome = normalizePath(upstreamHomePath || '/')

  let path = upstreamPath || '/'
  if (basePath && path.startsWith(basePath)) {
    path = path.slice(basePath.length) || '/'
  }

  if (normalizedHome !== '/') {
    if (path === normalizedHome || path === `${normalizedHome}/`) {
      return normalizedPrefix
    }
    if (path.startsWith(`${normalizedHome}/`)) {
      const suffix = path.slice(normalizedHome.length)
      return `${normalizedPrefix}${suffix}`
    }
  }

  if (path.startsWith('/post/')) {
    path = path.replace('/post/', '/')
  }

  if (path === '/') {
    return normalizedPrefix
  }

  return `${normalizedPrefix}${path}`
}

function rewriteUpstreamLocation(
  location, upstreamOrigin, publicOrigin, blogPrefix, upstreamBasePath, upstreamHomePath
) {
  if (!location) return null

  let target
  try {
    target = new URL(location, upstreamOrigin)
  } catch {
    return location
  }

  if (target.origin !== upstreamOrigin.origin) {
    return location
  }

  const publicPath = toPublicBlogPath(
    target.pathname, upstreamBasePath, blogPrefix, upstreamHomePath
  )

  return `${publicOrigin.origin}${publicPath}${target.search}${target.hash}`
}

function escapeForRegex(value) {
  return value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')
}

function rewriteHtmlLinks(
  html, upstreamOrigin, publicOrigin, blogPrefix, upstreamBasePath, upstreamHomePath
) {
  const basePath = normalizeBasePath(upstreamBasePath)
  const normalizedPrefix = normalizePrefix(blogPrefix)
  const normalizedHome = normalizePath(upstreamHomePath || '/')
  const escapedUpstream = escapeForRegex(upstreamOrigin.origin)
  const escapedBasePath = escapeForRegex(basePath)
  const escapedHome = escapeForRegex(normalizedHome)

  const fromPostPrefix = new RegExp(`${escapedUpstream}${escapedBasePath}/post/`, 'g')
  const fromPostWithoutBasePrefix = new RegExp(`${escapedUpstream}/post/`, 'g')
  const fromRootPrefix = new RegExp(`${escapedUpstream}${escapedBasePath}/`, 'g')

  let out = html.replace(fromPostPrefix, `${publicOrigin.origin}${normalizedPrefix}/`)
  out = out.replace(fromPostWithoutBasePrefix, `${publicOrigin.origin}${normalizedPrefix}/`)
  out = out.replace(fromRootPrefix, `${publicOrigin.origin}${normalizedPrefix}/`)

  if (normalizedHome !== '/') {
    const fromHomeExact = new RegExp(`${escapedUpstream}${escapedHome}(?=["'#?]|$)`, 'g')
    const fromHomePrefix = new RegExp(`${escapedUpstream}${escapedHome}/`, 'g')
    out = out.replace(fromHomeExact, `${publicOrigin.origin}${normalizedPrefix}`)
    out = out.replace(fromHomePrefix, `${publicOrigin.origin}${normalizedPrefix}/`)
  }

  if (basePath) {
    const basePathNoSlash = basePath.slice(1)
    const rootRegex = new RegExp(
      `(href|src|action)=("|')\\/${escapeForRegex(basePathNoSlash)}\\/([^"']*)("|')`, 'g'
    )
    out = out.replace(rootRegex, `$1=$2${normalizedPrefix}/$3$4`)
  }

  const rootPostRegex = new RegExp(`(href|src|action)=("|')\\/post\\/([^"']*)("|')`, 'g')
  out = out.replace(rootPostRegex, `$1=$2${normalizedPrefix}/$3$4`)

  if (normalizedHome !== '/') {
    const homeNoSlash = normalizedHome.slice(1)
    const homeRegex = new RegExp(
      `(href|src|action)=("|')\\/${escapeForRegex(homeNoSlash)}(?:\\/([^"']*))?("|')`, 'g'
    )
    out = out.replace(homeRegex, (_m, attr, quoteStart, suffix = '', quoteEnd) => {
      const normalizedSuffix = suffix ? `/${suffix}` : ''
      return `${attr}=${quoteStart}${normalizedPrefix}${normalizedSuffix}${quoteEnd}`
    })
  }

  return out
}

function buildRequestInit(request, headers) {
  const init = {
    method: request.method,
    headers,
    redirect: 'manual',
  }

  if (!['GET', 'HEAD'].includes(request.method)) {
    init.body = request.body
  }

  return init
}

export default {
  async fetch(request, env) {
    const incomingUrl = new URL(request.url)
    const blogPrefix = normalizePrefix(env.PUBLIC_BLOG_PREFIX)
    const upstreamBasePath = normalizeBasePath(env.UPSTREAM_BLOG_BASE_PATH)
    const upstreamHomePath = normalizePath(env.UPSTREAM_HOME_PATH || '/')

    // Proxy /robots.txt too so the blog sitemap is discoverable
    if (incomingUrl.pathname === '/robots.txt') {
      const upstreamOrigin = new URL(env.UPSTREAM_ORIGIN || 'https://blogs.a1traininggroupllc.com')
      const upstreamUrl = new URL(upstreamOrigin)
      upstreamUrl.pathname = '/robots.txt'

      const headers = new Headers(request.headers)
      headers.set('host', upstreamOrigin.host)
      const upstreamRequest = new Request(upstreamUrl.toString(), buildRequestInit(request, headers))
      return fetch(upstreamRequest)
    }

    if (!incomingUrl.pathname.startsWith(blogPrefix)) {
      return new Response('Not Found', { status: 404 })
    }

    const upstreamOrigin = new URL(env.UPSTREAM_ORIGIN || 'https://blogs.a1traininggroupllc.com')

    const publicOrigin = new URL(request.url)
    if (env.FORCE_PUBLIC_HOST) {
      publicOrigin.hostname = env.FORCE_PUBLIC_HOST
    }

    const upstreamUrl = new URL(upstreamOrigin)
    upstreamUrl.pathname = joinPaths(
      upstreamBasePath,
      mapBlogPath(incomingUrl.pathname, blogPrefix, upstreamHomePath)
    )
    upstreamUrl.search = incomingUrl.search

    const headers = new Headers(request.headers)
    headers.set('host', upstreamOrigin.host)
    headers.set('x-forwarded-host', incomingUrl.host)
    headers.set('x-forwarded-proto', incomingUrl.protocol.replace(':', ''))

    if (env.PROXY_BYPASS_HEADER && env.PROXY_BYPASS_VALUE) {
      headers.set(env.PROXY_BYPASS_HEADER, env.PROXY_BYPASS_VALUE)
    }

    const upstreamRequest = new Request(upstreamUrl.toString(), buildRequestInit(request, headers))
    const upstreamResponse = await fetch(upstreamRequest)

    if (upstreamResponse.status >= 300 && upstreamResponse.status < 400) {
      const location = upstreamResponse.headers.get('location')
      const rewrittenLocation = rewriteUpstreamLocation(
        location, upstreamOrigin, publicOrigin, blogPrefix, upstreamBasePath, upstreamHomePath
      )

      const redirectHeaders = new Headers(upstreamResponse.headers)
      if (rewrittenLocation) {
        redirectHeaders.set('location', rewrittenLocation)
      }

      return new Response(null, {
        status: upstreamResponse.status,
        headers: redirectHeaders,
      })
    }

    const contentType = upstreamResponse.headers.get('content-type') || ''
    if (contentType.includes('text/html')) {
      const html = await upstreamResponse.text()
      const rewrittenHtml = rewriteHtmlLinks(
        html, upstreamOrigin, publicOrigin, blogPrefix, upstreamBasePath, upstreamHomePath
      )
      const responseHeaders = new Headers(upstreamResponse.headers)
      responseHeaders.delete('content-length')

      return new Response(rewrittenHtml, {
        status: upstreamResponse.status,
        statusText: upstreamResponse.statusText,
        headers: responseHeaders,
      })
    }

    return upstreamResponse
  },
}
