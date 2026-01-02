<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel AniYume API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "https://leanna-superurgent-unfearfully.ngrok-free.dev";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-documentation">
                                <a href="#endpoints-GETapi-documentation">Handles the API request and renders the Swagger documentation view.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-oauth2-callback">
                                <a href="#endpoints-GETapi-oauth2-callback">Handles the OAuth2 callback and retrieves the required file for the redirect.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-anime">
                                <a href="#endpoints-GETapi-v1-public-anime">GET api/v1/public/anime</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-episodes-translators">
                                <a href="#endpoints-GETapi-v1-public-episodes-translators">GET api/v1/public/episodes/translators</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-episodes">
                                <a href="#endpoints-GETapi-v1-public-episodes">GET api/v1/public/episodes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-tags">
                                <a href="#endpoints-GETapi-v1-public-tags">GET api/v1/public/tags</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-anime--anime_id-">
                                <a href="#endpoints-GETapi-v1-public-anime--anime_id-">GET api/v1/public/anime/{anime_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-anime--anime_id--comments">
                                <a href="#endpoints-GETapi-v1-public-anime--anime_id--comments">GET api/v1/public/anime/{anime_id}/comments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-anime--anime_id--episodes">
                                <a href="#endpoints-GETapi-v1-public-anime--anime_id--episodes">GET api/v1/public/anime/{anime_id}/episodes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-anime--anime_id--community-stats">
                                <a href="#endpoints-GETapi-v1-public-anime--anime_id--community-stats">GET api/v1/public/anime/{anime_id}/community-stats</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-episodes--episode-">
                                <a href="#endpoints-GETapi-v1-public-episodes--episode-">GET api/v1/public/episodes/{episode}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-episodes--episode--player">
                                <a href="#endpoints-GETapi-v1-public-episodes--episode--player">GET api/v1/public/episodes/{episode}/player</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-public-users--userId--statistics">
                                <a href="#endpoints-GETapi-v1-public-users--userId--statistics">GET api/v1/public/users/{userId}/statistics</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-register">
                                <a href="#endpoints-POSTapi-v1-auth-register">POST api/v1/auth/register</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-login">
                                <a href="#endpoints-POSTapi-v1-auth-login">POST api/v1/auth/login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-user">
                                <a href="#endpoints-GETapi-v1-user">GET api/v1/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-auth-logout">
                                <a href="#endpoints-POSTapi-v1-auth-logout">POST api/v1/auth/logout</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-my-comments">
                                <a href="#endpoints-GETapi-v1-my-comments">GET api/v1/my-comments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-comments">
                                <a href="#endpoints-POSTapi-v1-comments">POST api/v1/comments</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-comments--id-">
                                <a href="#endpoints-PUTapi-v1-comments--id-">PUT api/v1/comments/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-comments--id-">
                                <a href="#endpoints-DELETEapi-v1-comments--id-">DELETE api/v1/comments/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-profile-me">
                                <a href="#endpoints-GETapi-v1-profile-me">GET api/v1/profile/me</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-profile-me">
                                <a href="#endpoints-PUTapi-v1-profile-me">PUT api/v1/profile/me</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-profile-me-avatar">
                                <a href="#endpoints-POSTapi-v1-profile-me-avatar">POST api/v1/profile/me/avatar</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-statistics-me">
                                <a href="#endpoints-GETapi-v1-statistics-me">GET api/v1/statistics/me</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-statistics-me-episodes-summary">
                                <a href="#endpoints-GETapi-v1-statistics-me-episodes-summary">GET api/v1/statistics/me/episodes-summary</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-anime--anime--status">
                                <a href="#endpoints-POSTapi-v1-anime--anime--status">POST api/v1/anime/{anime}/status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-anime--anime--user-status">
                                <a href="#endpoints-GETapi-v1-anime--anime--user-status">GET api/v1/anime/{anime}/user-status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">
                                <a href="#endpoints-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">PATCH api/v1/anime/{anime}/episodes-watched/{episodesWatched}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-my-anime-list--status--">
                                <a href="#endpoints-GETapi-v1-my-anime-list--status--">GET api/v1/my-anime-list/{status?}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-favorites">
                                <a href="#endpoints-GETapi-v1-favorites">GET api/v1/favorites</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-favorites">
                                <a href="#endpoints-POSTapi-v1-favorites">POST api/v1/favorites</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-favorites--animeId-">
                                <a href="#endpoints-DELETEapi-v1-favorites--animeId-">DELETE api/v1/favorites/{animeId}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-favorites--animeId--check">
                                <a href="#endpoints-GETapi-v1-favorites--animeId--check">GET api/v1/favorites/{animeId}/check</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-watch-history">
                                <a href="#endpoints-GETapi-v1-watch-history">GET api/v1/watch-history</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-watch-history">
                                <a href="#endpoints-POSTapi-v1-watch-history">POST api/v1/watch-history</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-watch-history--id-">
                                <a href="#endpoints-GETapi-v1-watch-history--id-">GET api/v1/watch-history/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-watch-history--id-">
                                <a href="#endpoints-DELETEapi-v1-watch-history--id-">DELETE api/v1/watch-history/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-watch-history-anime--animeId--history">
                                <a href="#endpoints-GETapi-v1-watch-history-anime--animeId--history">GET api/v1/watch-history/anime/{animeId}/history</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-watch-history-anime--animeId--last-episode">
                                <a href="#endpoints-GETapi-v1-watch-history-anime--animeId--last-episode">GET api/v1/watch-history/anime/{animeId}/last-episode</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-ratings">
                                <a href="#endpoints-GETapi-v1-ratings">GET api/v1/ratings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-v1-ratings">
                                <a href="#endpoints-POSTapi-v1-ratings">POST api/v1/ratings</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-v1-ratings--rating_id-">
                                <a href="#endpoints-DELETEapi-v1-ratings--rating_id-">DELETE api/v1/ratings/{rating_id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-ratings-anime--animeId-">
                                <a href="#endpoints-GETapi-v1-ratings-anime--animeId-">GET api/v1/ratings/anime/{animeId}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-anime-list--status--">
                                <a href="#endpoints-GETapi-v1-anime-list--status--">GET api/v1/anime-list/{status?}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-v1-anime-list-anime--anime--status">
                                <a href="#endpoints-GETapi-v1-anime-list-anime--anime--status">GET api/v1/anime-list/anime/{anime}/status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-anime-list-anime--anime--status">
                                <a href="#endpoints-PUTapi-v1-anime-list-anime--anime--status">PUT api/v1/anime-list/anime/{anime}/status</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-v1-anime-list-anime--anime--watched">
                                <a href="#endpoints-PUTapi-v1-anime-list-anime--anime--watched">PUT api/v1/anime-list/anime/{anime}/watched</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: January 2, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>https://leanna-superurgent-unfearfully.ngrok-free.dev</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-documentation">Handles the API request and renders the Swagger documentation view.</h2>

<p>
</p>



<span id="example-requests-GETapi-documentation">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/documentation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/documentation"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-documentation">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-documentation" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-documentation"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-documentation"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-documentation" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-documentation">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-documentation" data-method="GET"
      data-path="api/documentation"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-documentation', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-documentation"
                    onclick="tryItOut('GETapi-documentation');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-documentation"
                    onclick="cancelTryOut('GETapi-documentation');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-documentation"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/documentation</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-documentation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-documentation"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-oauth2-callback">Handles the OAuth2 callback and retrieves the required file for the redirect.</h2>

<p>
</p>



<span id="example-requests-GETapi-oauth2-callback">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/oauth2-callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/oauth2-callback"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-oauth2-callback">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">content-type: text/html; charset=utf-8
cache-control: no-cache, private
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!doctype html&gt;
&lt;html lang=&quot;en-US&quot;&gt;
&lt;body&gt;
&lt;script src=&quot;oauth2-redirect.js&quot;&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
    </span>
<span id="execution-results-GETapi-oauth2-callback" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-oauth2-callback"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-oauth2-callback"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-oauth2-callback" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-oauth2-callback">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-oauth2-callback" data-method="GET"
      data-path="api/oauth2-callback"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-oauth2-callback', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-oauth2-callback"
                    onclick="tryItOut('GETapi-oauth2-callback');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-oauth2-callback"
                    onclick="cancelTryOut('GETapi-oauth2-callback');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-oauth2-callback"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/oauth2-callback</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-oauth2-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-oauth2-callback"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-public-anime">GET api/v1/public/anime</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-anime">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Cowboy Bebop&quot;,
            &quot;slug&quot;: &quot;cowboy-bebop-1&quot;,
            &quot;description&quot;: &quot;Enter a world in the distant future, where Bounty Hunters roam the solar system. Spike and Jet, bounty hunting partners, set out on journeys in an ever struggling effort to win bounty rewards to survive.&lt;br&gt;&lt;br&gt;\nWhile traveling, they meet up with other very interesting people. Could Faye, the beautiful and ridiculously poor gambler, Edward, the computer genius, and Ein, the engineered dog be a good addition to the group?&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx1-GCsPm7waJ4kS.png&quot;,
            &quot;rating&quot;: &quot;8.60&quot;,
            &quot;year&quot;: 1998,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 26,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 420938,
            &quot;favorites&quot;: 25786,
            &quot;external_id&quot;: &quot;1&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Space&quot;,
                    &quot;slug&quot;: &quot;space&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Episodic&quot;,
                    &quot;slug&quot;: &quot;episodic&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Noir&quot;,
                    &quot;slug&quot;: &quot;noir&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Cyberpunk&quot;,
                    &quot;slug&quot;: &quot;cyberpunk&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;name&quot;: &quot;Terrorism&quot;,
                    &quot;slug&quot;: &quot;terrorism&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Female Protagonist&quot;,
                    &quot;slug&quot;: &quot;female-protagonist&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cyborg&quot;,
                    &quot;slug&quot;: &quot;cyborg&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Tomboy&quot;,
                    &quot;slug&quot;: &quot;tomboy&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Amnesia&quot;,
                    &quot;slug&quot;: &quot;amnesia&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Gambling&quot;,
                    &quot;slug&quot;: &quot;gambling&quot;
                },
                {
                    &quot;id&quot;: 27,
                    &quot;name&quot;: &quot;Cowboys&quot;,
                    &quot;slug&quot;: &quot;cowboys&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;name&quot;: &quot;Yakuza&quot;,
                    &quot;slug&quot;: &quot;yakuza&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;name&quot;: &quot;Drugs&quot;,
                    &quot;slug&quot;: &quot;drugs&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Police&quot;,
                    &quot;slug&quot;: &quot;police&quot;
                },
                {
                    &quot;id&quot;: 31,
                    &quot;name&quot;: &quot;Nudity&quot;,
                    &quot;slug&quot;: &quot;nudity&quot;
                },
                {
                    &quot;id&quot;: 32,
                    &quot;name&quot;: &quot;Tanned Skin&quot;,
                    &quot;slug&quot;: &quot;tanned-skin&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;Cult&quot;,
                    &quot;slug&quot;: &quot;cult&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Circus&quot;,
                    &quot;slug&quot;: &quot;circus&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 36,
                    &quot;name&quot;: &quot;Work&quot;,
                    &quot;slug&quot;: &quot;work&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:04.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Cowboy Bebop: The Movie - Knockin&#039; on Heaven&#039;s Door&quot;,
            &quot;slug&quot;: &quot;cowboy-bebop-the-movie-knockin-on-heavens-door-5&quot;,
            &quot;description&quot;: &quot;As the Cowboy Bebop crew travels the stars, they learn of the largest bounty yet, a huge 300 million Woolongs. Apparently, someone is wielding a hugely powerful chemical weapon, and of course the authorities are at a loss to stop it. The war to take down the most dangerous criminal yet forces the crew to face a true madman, with bare hope to succeed.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx5-NozHwXWdNLCz.jpg&quot;,
            &quot;rating&quot;: &quot;8.20&quot;,
            &quot;year&quot;: 2001,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;movie&quot;,
            &quot;number_of_episodes&quot;: 1,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 77448,
            &quot;favorites&quot;: 1409,
            &quot;external_id&quot;: &quot;5&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Space&quot;,
                    &quot;slug&quot;: &quot;space&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Noir&quot;,
                    &quot;slug&quot;: &quot;noir&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Cyberpunk&quot;,
                    &quot;slug&quot;: &quot;cyberpunk&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;name&quot;: &quot;Terrorism&quot;,
                    &quot;slug&quot;: &quot;terrorism&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Female Protagonist&quot;,
                    &quot;slug&quot;: &quot;female-protagonist&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cyborg&quot;,
                    &quot;slug&quot;: &quot;cyborg&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Tomboy&quot;,
                    &quot;slug&quot;: &quot;tomboy&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Amnesia&quot;,
                    &quot;slug&quot;: &quot;amnesia&quot;
                },
                {
                    &quot;id&quot;: 36,
                    &quot;name&quot;: &quot;Work&quot;,
                    &quot;slug&quot;: &quot;work&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Foreign&quot;,
                    &quot;slug&quot;: &quot;foreign&quot;
                },
                {
                    &quot;id&quot;: 40,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:04.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;Trigun&quot;,
            &quot;slug&quot;: &quot;trigun-6&quot;,
            &quot;description&quot;: &quot;Vash the Stampede is a wanted man with a habit of turning entire towns into rubble. The price on his head is a fortune, and his path of destruction reaches across the arid wastelands of a desert planet. Unfortunately, most encounters with the spiky-haired gunslinger don&#039;t end well for the bounty hunters who catch up with him; someone almost always gets hurt - and it&#039;s never Vash.&lt;br&gt;\n&lt;br&gt;\nOddly enough, for such an infamous fugitive, there&#039;s no proof that he&#039;s ever taken a life. In fact, he&#039;s a pacifist with a doughnut obsession who&#039;s more doofus than desperado. There&#039;s a whole lot more to him than his reputation lets on - Vash the Stampede definitely ain&#039;t your typical outlaw.&lt;br&gt;\n&lt;br&gt;\n(Source: Funimation)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx6-wd4saT1JzStH.jpg&quot;,
            &quot;rating&quot;: &quot;8.00&quot;,
            &quot;year&quot;: 1998,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 26,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 152749,
            &quot;favorites&quot;: 5834,
            &quot;external_id&quot;: &quot;6&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Space&quot;,
                    &quot;slug&quot;: &quot;space&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Episodic&quot;,
                    &quot;slug&quot;: &quot;episodic&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 27,
                    &quot;name&quot;: &quot;Cowboys&quot;,
                    &quot;slug&quot;: &quot;cowboys&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 42,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 44,
                    &quot;name&quot;: &quot;Desert&quot;,
                    &quot;slug&quot;: &quot;desert&quot;
                },
                {
                    &quot;id&quot;: 45,
                    &quot;name&quot;: &quot;Steampunk&quot;,
                    &quot;slug&quot;: &quot;steampunk&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 47,
                    &quot;name&quot;: &quot;Twins&quot;,
                    &quot;slug&quot;: &quot;twins&quot;
                },
                {
                    &quot;id&quot;: 48,
                    &quot;name&quot;: &quot;Aliens&quot;,
                    &quot;slug&quot;: &quot;aliens&quot;
                },
                {
                    &quot;id&quot;: 49,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 50,
                    &quot;name&quot;: &quot;Acrobatics&quot;,
                    &quot;slug&quot;: &quot;acrobatics&quot;
                },
                {
                    &quot;id&quot;: 51,
                    &quot;name&quot;: &quot;Rural&quot;,
                    &quot;slug&quot;: &quot;rural&quot;
                },
                {
                    &quot;id&quot;: 52,
                    &quot;name&quot;: &quot;Religion&quot;,
                    &quot;slug&quot;: &quot;religion&quot;
                },
                {
                    &quot;id&quot;: 53,
                    &quot;name&quot;: &quot;Body Horror&quot;,
                    &quot;slug&quot;: &quot;body-horror&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;Witch Hunter ROBIN&quot;,
            &quot;slug&quot;: &quot;witch-hunter-robin-7&quot;,
            &quot;description&quot;: &quot;Robin Sena is a powerful craft user drafted into the STNJ - a group of specialized hunters that fight deadly beings known as Witches. Though her fire power is great, she&rsquo;s got a lot to learn about her powers and working with her cool and aloof partner, Amon. But the truth about the Witches and herself will leave Robin on an entirely new path that she never expected!&lt;br&gt;\n&lt;br&gt;\n(Source: Funimation)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx7-6uh1fPvbgS9t.png&quot;,
            &quot;rating&quot;: &quot;6.80&quot;,
            &quot;year&quot;: 2002,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 26,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 21453,
            &quot;favorites&quot;: 229,
            &quot;external_id&quot;: &quot;7&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Noir&quot;,
                    &quot;slug&quot;: &quot;noir&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Female Protagonist&quot;,
                    &quot;slug&quot;: &quot;female-protagonist&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Police&quot;,
                    &quot;slug&quot;: &quot;police&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 42,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 55,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Magic&quot;,
                    &quot;slug&quot;: &quot;magic&quot;
                },
                {
                    &quot;id&quot;: 57,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 58,
                    &quot;name&quot;: &quot;Witch&quot;,
                    &quot;slug&quot;: &quot;witch&quot;
                },
                {
                    &quot;id&quot;: 59,
                    &quot;name&quot;: &quot;Bar&quot;,
                    &quot;slug&quot;: &quot;bar&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Beet the Vandel Buster&quot;,
            &quot;slug&quot;: &quot;beet-the-vandel-buster-8&quot;,
            &quot;description&quot;: &quot;It is the dark century and the people are suffering under the rule of the devil, Vandel, who is able to manipulate monsters. The Vandel Busters are a group of people who hunt these devils, and among them, the Zenon Squad is known to be the strongest busters on the continent. A young boy, Beet, dreams of joining the Zenon Squad. However, one day, as a result of Beet&#039;s fault, the Zenon squad was defeated by the devil, Beltose. The five dying busters sacrificed their life power into their five weapons, Saiga. After giving their weapons to Beet, they passed away. Years have passed since then and the young Vandel Buster, Beet, begins his adventure to carry out the Zenon Squad&#039;s will to put an end to the dark century. &quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/b8-ReS3TwSgrDDi.jpg&quot;,
            &quot;rating&quot;: &quot;6.60&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 52,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 2932,
            &quot;favorites&quot;: 38,
            &quot;external_id&quot;: &quot;8&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 61,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Spearplay&quot;,
                    &quot;slug&quot;: &quot;spearplay&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;Eyeshield 21&quot;,
            &quot;slug&quot;: &quot;eyeshield-21-15&quot;,
            &quot;description&quot;: &quot;Welcome To the Gridiron of the Damned!   Huge hulking bodies throw themselves at each other, while a tiny lithe body runs between them for the goal!  No, it&amp;rsquo;s not a game of football, it&amp;rsquo;s Sena Kobayakawa trying to evade the monstrous Ha-Ha brothers down the halls of Deimon High School!  But wait!  Sena&amp;rsquo;s incredible skills at not getting caught have been spotted by the devilish (possibly actually demonic) captain of the school&amp;rsquo;s embryonic American style football team, and when Sena asks to be the teams manager, he gets  thrust onto the field as a running back instead!  But there are two BIG catches: first, to keep the identity of their new &amp;ldquo;star&amp;rdquo; player an absolute secret, Yoichi makes Sena wear an opaque visor on his helmet and gives him the alias of &amp;ldquo;Eyeshield 21.&amp;rdquo;  And the second catch?  Well, in order to hit his fastest &amp;ldquo;speed of light&amp;rdquo; running mode, Sena usually has to be absolutely terrified. Not that THAT will be a problem with the monstrous players that he&amp;rsquo;ll soon find himself running from!  The insanity hits the streets when the feet meet the cleats in EYESHIELD 21! &lt;br&gt;&lt;br&gt;\n(Source: Sentai Filmworks)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx15-A4F2t0TgWoi4.png&quot;,
            &quot;rating&quot;: &quot;7.60&quot;,
            &quot;year&quot;: 2005,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 145,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 31507,
            &quot;favorites&quot;: 704,
            &quot;external_id&quot;: &quot;15&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 49,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Sports&quot;,
                    &quot;slug&quot;: &quot;sports&quot;
                },
                {
                    &quot;id&quot;: 65,
                    &quot;name&quot;: &quot;American Football&quot;,
                    &quot;slug&quot;: &quot;american-football&quot;
                },
                {
                    &quot;id&quot;: 66,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;School Club&quot;,
                    &quot;slug&quot;: &quot;school-club&quot;
                },
                {
                    &quot;id&quot;: 69,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 70,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 71,
                    &quot;name&quot;: &quot;Delinquents&quot;,
                    &quot;slug&quot;: &quot;delinquents&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Honey and Clover&quot;,
            &quot;slug&quot;: &quot;honey-and-clover-16&quot;,
            &quot;description&quot;: &quot;Takemoto Yuuta, Mayama Takumi, and Morita Shinobu are college students who share the small apartment. Even though they live in poverty, the three of them are able to obtain pleasure through small things in life. The story follows these characters&#039; life stories as poor college students, as well as their love lives when a short but talented 18 year old girl called Hanamoto Hagumi appears.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx16-S9k8qahNXoYP.jpg&quot;,
            &quot;rating&quot;: &quot;7.60&quot;,
            &quot;year&quot;: 2005,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 24,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 54611,
            &quot;favorites&quot;: 854,
            &quot;external_id&quot;: &quot;16&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 69,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 72,
                    &quot;name&quot;: &quot;Romance&quot;,
                    &quot;slug&quot;: &quot;romance&quot;
                },
                {
                    &quot;id&quot;: 73,
                    &quot;name&quot;: &quot;Slice of Life&quot;,
                    &quot;slug&quot;: &quot;slice-of-life&quot;
                },
                {
                    &quot;id&quot;: 74,
                    &quot;name&quot;: &quot;College&quot;,
                    &quot;slug&quot;: &quot;college&quot;
                },
                {
                    &quot;id&quot;: 75,
                    &quot;name&quot;: &quot;Love Triangle&quot;,
                    &quot;slug&quot;: &quot;love-triangle&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Josei&quot;,
                    &quot;slug&quot;: &quot;josei&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 78,
                    &quot;name&quot;: &quot;Chibi&quot;,
                    &quot;slug&quot;: &quot;chibi&quot;
                },
                {
                    &quot;id&quot;: 79,
                    &quot;name&quot;: &quot;Drawing&quot;,
                    &quot;slug&quot;: &quot;drawing&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Hungry Heart: Wild Striker&quot;,
            &quot;slug&quot;: &quot;hungry-heart-wild-striker-17&quot;,
            &quot;description&quot;: &quot;Kyosuke Kano has lived under the shadow of his successful brother Seisuke all his life who is a professional soccer player. Tired of being compared and downgraded at, he abandoned playing soccer until a boy from his new highschool discovered him and asked him to join their team. Kyosuke joins it and befriends two other first year players named Rodrigo and Sakai with the dream of becomming professional soccer players themselves.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx17-6kqIbdUk3dgi.png&quot;,
            &quot;rating&quot;: &quot;7.10&quot;,
            &quot;year&quot;: 2002,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 52,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 4514,
            &quot;favorites&quot;: 79,
            &quot;external_id&quot;: &quot;17&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Sports&quot;,
                    &quot;slug&quot;: &quot;sports&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;School Club&quot;,
                    &quot;slug&quot;: &quot;school-club&quot;
                },
                {
                    &quot;id&quot;: 73,
                    &quot;name&quot;: &quot;Slice of Life&quot;,
                    &quot;slug&quot;: &quot;slice-of-life&quot;
                },
                {
                    &quot;id&quot;: 80,
                    &quot;name&quot;: &quot;Football&quot;,
                    &quot;slug&quot;: &quot;football&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;Initial D 4th Stage&quot;,
            &quot;slug&quot;: &quot;initial-d-4th-stage-18&quot;,
            &quot;description&quot;: &quot;Takumi Fujiwara and brothers Keisuke and Ryousuke Takahashi have formed \&quot;Project D,\&quot; a racing team aimed at bringing their driving skills to their full potential outside their prefecture. Using the internet, Project D issues challenges to other racing teams and posts results of their races. Managed by Ryousuke, the team has Takumi engaging in downhill battles with his AE86, while Keisuke challenges opponents uphill. Among their rivals are the Seven-Star Leaf (SSR) and Todo-juku.&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/b18-r7IirVmwP89u.jpg&quot;,
            &quot;rating&quot;: &quot;8.00&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 24,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 44804,
            &quot;favorites&quot;: 846,
            &quot;external_id&quot;: &quot;18&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 51,
                    &quot;name&quot;: &quot;Rural&quot;,
                    &quot;slug&quot;: &quot;rural&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Sports&quot;,
                    &quot;slug&quot;: &quot;sports&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 81,
                    &quot;name&quot;: &quot;Cars&quot;,
                    &quot;slug&quot;: &quot;cars&quot;
                },
                {
                    &quot;id&quot;: 82,
                    &quot;name&quot;: &quot;Seinen&quot;,
                    &quot;slug&quot;: &quot;seinen&quot;
                },
                {
                    &quot;id&quot;: 83,
                    &quot;name&quot;: &quot;Rape&quot;,
                    &quot;slug&quot;: &quot;rape&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;title&quot;: &quot;Monster&quot;,
            &quot;slug&quot;: &quot;monster-19&quot;,
            &quot;description&quot;: &quot;Dr. Kenzo Tenma is a renowned Japanese brain surgeon working at a leading hospital in Germany. One night, Dr. Tenma risks his reputation and career to save the life of a critically wounded young boy over that of the town mayor who had been planning to support the hospital financially. A string of mysterious murders begin to occur soon after the operation, and Dr. Tenma emerges as the primary suspect despite no incriminating evidence. \n&lt;br&gt;&lt;br&gt;\nA doctor is taught to believe that all life is equal; however, when another series of murders occur in the surgeon&#039;s vicinity, Dr. Tenma&#039;s beliefs are shaken as his actions that night are shown to have much broader consequences than he could have imagined. Leaving behind his life as a surgeon he embarks on a journey across the country to unravel the mystery of the boy he saved.&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx19-gtMC64182sm4.jpg&quot;,
            &quot;rating&quot;: &quot;8.80&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 74,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 294354,
            &quot;favorites&quot;: 19674,
            &quot;external_id&quot;: &quot;19&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Episodic&quot;,
                    &quot;slug&quot;: &quot;episodic&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Noir&quot;,
                    &quot;slug&quot;: &quot;noir&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Amnesia&quot;,
                    &quot;slug&quot;: &quot;amnesia&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Police&quot;,
                    &quot;slug&quot;: &quot;police&quot;
                },
                {
                    &quot;id&quot;: 31,
                    &quot;name&quot;: &quot;Nudity&quot;,
                    &quot;slug&quot;: &quot;nudity&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Foreign&quot;,
                    &quot;slug&quot;: &quot;foreign&quot;
                },
                {
                    &quot;id&quot;: 42,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 47,
                    &quot;name&quot;: &quot;Twins&quot;,
                    &quot;slug&quot;: &quot;twins&quot;
                },
                {
                    &quot;id&quot;: 55,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 70,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 82,
                    &quot;name&quot;: &quot;Seinen&quot;,
                    &quot;slug&quot;: &quot;seinen&quot;
                },
                {
                    &quot;id&quot;: 83,
                    &quot;name&quot;: &quot;Rape&quot;,
                    &quot;slug&quot;: &quot;rape&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Horror&quot;,
                    &quot;slug&quot;: &quot;horror&quot;
                },
                {
                    &quot;id&quot;: 85,
                    &quot;name&quot;: &quot;Psychological&quot;,
                    &quot;slug&quot;: &quot;psychological&quot;
                },
                {
                    &quot;id&quot;: 86,
                    &quot;name&quot;: &quot;Thriller&quot;,
                    &quot;slug&quot;: &quot;thriller&quot;
                },
                {
                    &quot;id&quot;: 87,
                    &quot;name&quot;: &quot;Detective&quot;,
                    &quot;slug&quot;: &quot;detective&quot;
                },
                {
                    &quot;id&quot;: 88,
                    &quot;name&quot;: &quot;Memory Manipulation&quot;,
                    &quot;slug&quot;: &quot;memory-manipulation&quot;
                },
                {
                    &quot;id&quot;: 89,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 90,
                    &quot;name&quot;: &quot;Adoption&quot;,
                    &quot;slug&quot;: &quot;adoption&quot;
                },
                {
                    &quot;id&quot;: 91,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 92,
                    &quot;name&quot;: &quot;Dissociative Identities&quot;,
                    &quot;slug&quot;: &quot;dissociative-identities&quot;
                },
                {
                    &quot;id&quot;: 93,
                    &quot;name&quot;: &quot;Medicine&quot;,
                    &quot;slug&quot;: &quot;medicine&quot;
                },
                {
                    &quot;id&quot;: 94,
                    &quot;name&quot;: &quot;Orphan&quot;,
                    &quot;slug&quot;: &quot;orphan&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Historical&quot;,
                    &quot;slug&quot;: &quot;historical&quot;
                },
                {
                    &quot;id&quot;: 96,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 97,
                    &quot;name&quot;: &quot;Suicide&quot;,
                    &quot;slug&quot;: &quot;suicide&quot;
                },
                {
                    &quot;id&quot;: 98,
                    &quot;name&quot;: &quot;Torture&quot;,
                    &quot;slug&quot;: &quot;torture&quot;
                },
                {
                    &quot;id&quot;: 99,
                    &quot;name&quot;: &quot;Crossdressing&quot;,
                    &quot;slug&quot;: &quot;crossdressing&quot;
                },
                {
                    &quot;id&quot;: 100,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 101,
                    &quot;name&quot;: &quot;Rescue&quot;,
                    &quot;slug&quot;: &quot;rescue&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;title&quot;: &quot;Naruto&quot;,
            &quot;slug&quot;: &quot;naruto-20&quot;,
            &quot;description&quot;: &quot;Naruto Uzumaki, a hyperactive and knuckle-headed ninja, lives in Konohagakure, the Hidden Leaf village. Moments prior to his birth, a huge demon known as the Kyuubi, the Nine-tailed Fox, attacked Konohagakure and wreaked havoc. In order to put an end to the Kyuubi&#039;s rampage, the leader of the village, the 4th Hokage, sacrificed his life and sealed the monstrous beast inside the newborn Naruto. &lt;br&gt;&lt;br&gt;\nShunned because of the presence of the Kyuubi inside him, Naruto struggles to find his place in the village. He strives to become the Hokage of Konohagakure, and he meets many friends and foes along the way. &lt;br&gt;&lt;br&gt;\n(Source: MAL Rewrite)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx20-dE6UHbFFg1A5.jpg&quot;,
            &quot;rating&quot;: &quot;8.00&quot;,
            &quot;year&quot;: 2002,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 220,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 645564,
            &quot;favorites&quot;: 29428,
            &quot;external_id&quot;: &quot;20&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Gambling&quot;,
                    &quot;slug&quot;: &quot;gambling&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 49,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 61,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 66,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 69,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 70,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 75,
                    &quot;name&quot;: &quot;Love Triangle&quot;,
                    &quot;slug&quot;: &quot;love-triangle&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 89,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 94,
                    &quot;name&quot;: &quot;Orphan&quot;,
                    &quot;slug&quot;: &quot;orphan&quot;
                },
                {
                    &quot;id&quot;: 102,
                    &quot;name&quot;: &quot;Ninja&quot;,
                    &quot;slug&quot;: &quot;ninja&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 104,
                    &quot;name&quot;: &quot;Criminal Organization&quot;,
                    &quot;slug&quot;: &quot;criminal-organization&quot;
                },
                {
                    &quot;id&quot;: 105,
                    &quot;name&quot;: &quot;Primarily Child Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-child-cast&quot;
                },
                {
                    &quot;id&quot;: 106,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 107,
                    &quot;name&quot;: &quot;Anachronism&quot;,
                    &quot;slug&quot;: &quot;anachronism&quot;
                },
                {
                    &quot;id&quot;: 108,
                    &quot;name&quot;: &quot;Kaiju&quot;,
                    &quot;slug&quot;: &quot;kaiju&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Necromancy&quot;,
                    &quot;slug&quot;: &quot;necromancy&quot;
                },
                {
                    &quot;id&quot;: 110,
                    &quot;name&quot;: &quot;Estranged Family&quot;,
                    &quot;slug&quot;: &quot;estranged-family&quot;
                },
                {
                    &quot;id&quot;: 111,
                    &quot;name&quot;: &quot;Gender Bending&quot;,
                    &quot;slug&quot;: &quot;gender-bending&quot;
                },
                {
                    &quot;id&quot;: 112,
                    &quot;name&quot;: &quot;Assassins&quot;,
                    &quot;slug&quot;: &quot;assassins&quot;
                },
                {
                    &quot;id&quot;: 113,
                    &quot;name&quot;: &quot;Battle Royale&quot;,
                    &quot;slug&quot;: &quot;battle-royale&quot;
                },
                {
                    &quot;id&quot;: 114,
                    &quot;name&quot;: &quot;Anthropomorphism&quot;,
                    &quot;slug&quot;: &quot;anthropomorphism&quot;
                },
                {
                    &quot;id&quot;: 115,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 13,
            &quot;title&quot;: &quot;ONE PIECE&quot;,
            &quot;slug&quot;: &quot;one-piece-21&quot;,
            &quot;description&quot;: &quot;Gold Roger was known as the Pirate King, the strongest and most infamous being to have sailed the Grand Line. The capture and death of Roger by the World Government brought a change throughout the world. His last words before his death revealed the location of the greatest treasure in the world, One Piece. It was this revelation that brought about the Grand Age of Pirates, men who dreamed of finding One Piece (which promises an unlimited amount of riches and fame), and quite possibly the most coveted of titles for the person who found it, the title of the Pirate King.&lt;br&gt;&lt;br&gt;\nEnter Monkey D. Luffy, a 17-year-old boy that defies your standard definition of a pirate. Rather than the popular persona of a wicked, hardened, toothless pirate who ransacks villages for fun, Luffy&rsquo;s reason for being a pirate is one of pure wonder; the thought of an exciting adventure and meeting new and intriguing people, along with finding One Piece, are his reasons of becoming a pirate. Following in the footsteps of his childhood hero, Luffy and his crew travel across the Grand Line, experiencing crazy adventures, unveiling dark mysteries and battling strong enemies, all in order to reach One Piece.&lt;br&gt;&lt;br&gt;\n&lt;b&gt;*This includes following special episodes:&lt;/b&gt;&lt;br&gt;\n- Chopperman to the Rescue! Protect the TV Station by the Shore! (Episode 336)&lt;br&gt;\n- The Strongest Tag-Team! Luffy and Toriko&#039;s Hard Struggle! (Episode 492)&lt;br&gt;\n- Team Formation! Save Chopper (Episode 542)&lt;br&gt;\n- History&#039;s Strongest Collaboration vs. Glutton of the Sea (Episode 590)&lt;br&gt;\n- 20th Anniversary! Special Romance Dawn (Episode 907)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21-ELSYx3yMPcKM.jpg&quot;,
            &quot;rating&quot;: &quot;8.80&quot;,
            &quot;year&quot;: 1999,
            &quot;status&quot;: &quot;releasing&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: null,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 650614,
            &quot;favorites&quot;: 90798,
            &quot;external_id&quot;: &quot;21&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cyborg&quot;,
                    &quot;slug&quot;: &quot;cyborg&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;name&quot;: &quot;Drugs&quot;,
                    &quot;slug&quot;: &quot;drugs&quot;
                },
                {
                    &quot;id&quot;: 31,
                    &quot;name&quot;: &quot;Nudity&quot;,
                    &quot;slug&quot;: &quot;nudity&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 42,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 44,
                    &quot;name&quot;: &quot;Desert&quot;,
                    &quot;slug&quot;: &quot;desert&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 49,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 55,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 61,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 89,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 90,
                    &quot;name&quot;: &quot;Adoption&quot;,
                    &quot;slug&quot;: &quot;adoption&quot;
                },
                {
                    &quot;id&quot;: 91,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 93,
                    &quot;name&quot;: &quot;Medicine&quot;,
                    &quot;slug&quot;: &quot;medicine&quot;
                },
                {
                    &quot;id&quot;: 96,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 102,
                    &quot;name&quot;: &quot;Ninja&quot;,
                    &quot;slug&quot;: &quot;ninja&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 106,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 107,
                    &quot;name&quot;: &quot;Anachronism&quot;,
                    &quot;slug&quot;: &quot;anachronism&quot;
                },
                {
                    &quot;id&quot;: 111,
                    &quot;name&quot;: &quot;Gender Bending&quot;,
                    &quot;slug&quot;: &quot;gender-bending&quot;
                },
                {
                    &quot;id&quot;: 112,
                    &quot;name&quot;: &quot;Assassins&quot;,
                    &quot;slug&quot;: &quot;assassins&quot;
                },
                {
                    &quot;id&quot;: 113,
                    &quot;name&quot;: &quot;Battle Royale&quot;,
                    &quot;slug&quot;: &quot;battle-royale&quot;
                },
                {
                    &quot;id&quot;: 114,
                    &quot;name&quot;: &quot;Anthropomorphism&quot;,
                    &quot;slug&quot;: &quot;anthropomorphism&quot;
                },
                {
                    &quot;id&quot;: 116,
                    &quot;name&quot;: &quot;Pirates&quot;,
                    &quot;slug&quot;: &quot;pirates&quot;
                },
                {
                    &quot;id&quot;: 117,
                    &quot;name&quot;: &quot;Ships&quot;,
                    &quot;slug&quot;: &quot;ships&quot;
                },
                {
                    &quot;id&quot;: 118,
                    &quot;name&quot;: &quot;War&quot;,
                    &quot;slug&quot;: &quot;war&quot;
                },
                {
                    &quot;id&quot;: 119,
                    &quot;name&quot;: &quot;Slavery&quot;,
                    &quot;slug&quot;: &quot;slavery&quot;
                },
                {
                    &quot;id&quot;: 120,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 121,
                    &quot;name&quot;: &quot;Gods&quot;,
                    &quot;slug&quot;: &quot;gods&quot;
                },
                {
                    &quot;id&quot;: 122,
                    &quot;name&quot;: &quot;Lost Civilization&quot;,
                    &quot;slug&quot;: &quot;lost-civilization&quot;
                },
                {
                    &quot;id&quot;: 123,
                    &quot;name&quot;: &quot;Monster Boy&quot;,
                    &quot;slug&quot;: &quot;monster-boy&quot;
                },
                {
                    &quot;id&quot;: 124,
                    &quot;name&quot;: &quot;Prison&quot;,
                    &quot;slug&quot;: &quot;prison&quot;
                },
                {
                    &quot;id&quot;: 125,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 126,
                    &quot;name&quot;: &quot;Food&quot;,
                    &quot;slug&quot;: &quot;food&quot;
                },
                {
                    &quot;id&quot;: 127,
                    &quot;name&quot;: &quot;Robots&quot;,
                    &quot;slug&quot;: &quot;robots&quot;
                },
                {
                    &quot;id&quot;: 128,
                    &quot;name&quot;: &quot;Samurai&quot;,
                    &quot;slug&quot;: &quot;samurai&quot;
                },
                {
                    &quot;id&quot;: 129,
                    &quot;name&quot;: &quot;Animals&quot;,
                    &quot;slug&quot;: &quot;animals&quot;
                },
                {
                    &quot;id&quot;: 130,
                    &quot;name&quot;: &quot;Skeleton&quot;,
                    &quot;slug&quot;: &quot;skeleton&quot;
                },
                {
                    &quot;id&quot;: 131,
                    &quot;name&quot;: &quot;Dragons&quot;,
                    &quot;slug&quot;: &quot;dragons&quot;
                },
                {
                    &quot;id&quot;: 132,
                    &quot;name&quot;: &quot;Asexual&quot;,
                    &quot;slug&quot;: &quot;asexual&quot;
                },
                {
                    &quot;id&quot;: 133,
                    &quot;name&quot;: &quot;Espionage&quot;,
                    &quot;slug&quot;: &quot;espionage&quot;
                },
                {
                    &quot;id&quot;: 134,
                    &quot;name&quot;: &quot;Monster Girl&quot;,
                    &quot;slug&quot;: &quot;monster-girl&quot;
                },
                {
                    &quot;id&quot;: 135,
                    &quot;name&quot;: &quot;Marriage&quot;,
                    &quot;slug&quot;: &quot;marriage&quot;
                },
                {
                    &quot;id&quot;: 136,
                    &quot;name&quot;: &quot;Artificial Intelligence&quot;,
                    &quot;slug&quot;: &quot;artificial-intelligence&quot;
                },
                {
                    &quot;id&quot;: 137,
                    &quot;name&quot;: &quot;Demons&quot;,
                    &quot;slug&quot;: &quot;demons&quot;
                },
                {
                    &quot;id&quot;: 138,
                    &quot;name&quot;: &quot;Fairy&quot;,
                    &quot;slug&quot;: &quot;fairy&quot;
                },
                {
                    &quot;id&quot;: 139,
                    &quot;name&quot;: &quot;Aromantic&quot;,
                    &quot;slug&quot;: &quot;aromantic&quot;
                },
                {
                    &quot;id&quot;: 140,
                    &quot;name&quot;: &quot;Arranged Marriage&quot;,
                    &quot;slug&quot;: &quot;arranged-marriage&quot;
                },
                {
                    &quot;id&quot;: 141,
                    &quot;name&quot;: &quot;Mermaid&quot;,
                    &quot;slug&quot;: &quot;mermaid&quot;
                },
                {
                    &quot;id&quot;: 142,
                    &quot;name&quot;: &quot;Time Manipulation&quot;,
                    &quot;slug&quot;: &quot;time-manipulation&quot;
                },
                {
                    &quot;id&quot;: 143,
                    &quot;name&quot;: &quot;Clone&quot;,
                    &quot;slug&quot;: &quot;clone&quot;
                },
                {
                    &quot;id&quot;: 144,
                    &quot;name&quot;: &quot;Musical Theater&quot;,
                    &quot;slug&quot;: &quot;musical-theater&quot;
                },
                {
                    &quot;id&quot;: 145,
                    &quot;name&quot;: &quot;Zombie&quot;,
                    &quot;slug&quot;: &quot;zombie&quot;
                },
                {
                    &quot;id&quot;: 146,
                    &quot;name&quot;: &quot;Kabuki&quot;,
                    &quot;slug&quot;: &quot;kabuki&quot;
                },
                {
                    &quot;id&quot;: 147,
                    &quot;name&quot;: &quot;Angels&quot;,
                    &quot;slug&quot;: &quot;angels&quot;
                },
                {
                    &quot;id&quot;: 148,
                    &quot;name&quot;: &quot;Trains&quot;,
                    &quot;slug&quot;: &quot;trains&quot;
                },
                {
                    &quot;id&quot;: 149,
                    &quot;name&quot;: &quot;LGBTQ+ Themes&quot;,
                    &quot;slug&quot;: &quot;lgbtq-themes&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;title&quot;: &quot;The Prince of Tennis&quot;,
            &quot;slug&quot;: &quot;the-prince-of-tennis-22&quot;,
            &quot;description&quot;: &quot;Echizen Ryoma is a young tennis prodigy who has won 4 consecutive tennis championships but who constantly lies in the shadow of his father, a former pro tennis player. He joins the Seishun Gakuen junior highschool, one of the best tennis schools in Japan, and there along with his teamates he learns to find his own type of tennis in an attempt to defeat his biggest obstacle of all: his father as well as himself.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx22-yEguU9EmxkjK.png&quot;,
            &quot;rating&quot;: &quot;7.50&quot;,
            &quot;year&quot;: 2001,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 178,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 33359,
            &quot;favorites&quot;: 674,
            &quot;external_id&quot;: &quot;22&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Foreign&quot;,
                    &quot;slug&quot;: &quot;foreign&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Sports&quot;,
                    &quot;slug&quot;: &quot;sports&quot;
                },
                {
                    &quot;id&quot;: 66,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;School Club&quot;,
                    &quot;slug&quot;: &quot;school-club&quot;
                },
                {
                    &quot;id&quot;: 70,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 105,
                    &quot;name&quot;: &quot;Primarily Child Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-child-cast&quot;
                },
                {
                    &quot;id&quot;: 150,
                    &quot;name&quot;: &quot;Tennis&quot;,
                    &quot;slug&quot;: &quot;tennis&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;title&quot;: &quot;Ring ni Kakero 1&quot;,
            &quot;slug&quot;: &quot;ring-ni-kakero-1-23&quot;,
            &quot;description&quot;: &quot;In order to fulfill their dead father&#039;s wish, the siblings, Kiku Takane and Ryuuji Takane aim for the champion title of the boxing arena. The sister, Kiku, will act as the trainer while her brother, Ryuuji, will concentrate on the role of the boxer and learn the Boomerang Hook technique. His battle with many rivals has led to the growth and maturity of Ryuuji. The junior high boxing tournament has began and Ryuuji will be fighting his arch-rival, Jun Kenzaki. The battle begins.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx23-OwtP69d9B9kg.jpg&quot;,
            &quot;rating&quot;: &quot;6.00&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 12,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 1573,
            &quot;favorites&quot;: 23,
            &quot;external_id&quot;: &quot;23&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Sports&quot;,
                    &quot;slug&quot;: &quot;sports&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 71,
                    &quot;name&quot;: &quot;Delinquents&quot;,
                    &quot;slug&quot;: &quot;delinquents&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 151,
                    &quot;name&quot;: &quot;Boxing&quot;,
                    &quot;slug&quot;: &quot;boxing&quot;
                },
                {
                    &quot;id&quot;: 152,
                    &quot;name&quot;: &quot;Cultivation&quot;,
                    &quot;slug&quot;: &quot;cultivation&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;School Rumble&quot;,
            &quot;slug&quot;: &quot;school-rumble-24&quot;,
            &quot;description&quot;: &quot;Tsukamoto Tenma is an ordinary 2nd year high school student who has fallen in love with one of her classmates, Karasuma Ooji. However, currently she is unable to confess her feelings to him. To make things worse, she found out that Karasuma is transferring to another school in a year. On the other hand, Tenma&#039;s other classmate, Harima Kenji (who is a delinquent) is also in love with Tenma. Not being able to confess his feelings, Harima gets depressed day by day.&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx24-FY8Y08LrROKE.png&quot;,
            &quot;rating&quot;: &quot;7.60&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 26,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 55072,
            &quot;favorites&quot;: 1036,
            &quot;external_id&quot;: &quot;24&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Episodic&quot;,
                    &quot;slug&quot;: &quot;episodic&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 66,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 71,
                    &quot;name&quot;: &quot;Delinquents&quot;,
                    &quot;slug&quot;: &quot;delinquents&quot;
                },
                {
                    &quot;id&quot;: 72,
                    &quot;name&quot;: &quot;Romance&quot;,
                    &quot;slug&quot;: &quot;romance&quot;
                },
                {
                    &quot;id&quot;: 73,
                    &quot;name&quot;: &quot;Slice of Life&quot;,
                    &quot;slug&quot;: &quot;slice-of-life&quot;
                },
                {
                    &quot;id&quot;: 75,
                    &quot;name&quot;: &quot;Love Triangle&quot;,
                    &quot;slug&quot;: &quot;love-triangle&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 115,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 153,
                    &quot;name&quot;: &quot;Parody&quot;,
                    &quot;slug&quot;: &quot;parody&quot;
                },
                {
                    &quot;id&quot;: 154,
                    &quot;name&quot;: &quot;Tsundere&quot;,
                    &quot;slug&quot;: &quot;tsundere&quot;
                },
                {
                    &quot;id&quot;: 155,
                    &quot;name&quot;: &quot;Butler&quot;,
                    &quot;slug&quot;: &quot;butler&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;title&quot;: &quot;Desert Punk&quot;,
            &quot;slug&quot;: &quot;desert-punk-25&quot;,
            &quot;description&quot;: &quot;The Great Kanto Desert is a miserable place. It&rsquo;s also the home of hero-for-hire Desert Punk, the closest thing to a good guy the wasteland&rsquo;s got. He&rsquo;s known as the best man for any job, but his reputation is undone by his raging hormones when curvy Junko uses her double-D charms to double-cross him. With debt hanging over his head, Desert Punk sets out to salvage his name. &lt;br&gt;&lt;br&gt;\n(Source: Crunchyroll)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx25-H1etX7IgfFtQ.jpg&quot;,
            &quot;rating&quot;: &quot;6.80&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 24,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 27073,
            &quot;favorites&quot;: 331,
            &quot;external_id&quot;: &quot;25&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Episodic&quot;,
                    &quot;slug&quot;: &quot;episodic&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;name&quot;: &quot;Terrorism&quot;,
                    &quot;slug&quot;: &quot;terrorism&quot;
                },
                {
                    &quot;id&quot;: 40,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 44,
                    &quot;name&quot;: &quot;Desert&quot;,
                    &quot;slug&quot;: &quot;desert&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 49,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 55,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 118,
                    &quot;name&quot;: &quot;War&quot;,
                    &quot;slug&quot;: &quot;war&quot;
                },
                {
                    &quot;id&quot;: 119,
                    &quot;name&quot;: &quot;Slavery&quot;,
                    &quot;slug&quot;: &quot;slavery&quot;
                },
                {
                    &quot;id&quot;: 122,
                    &quot;name&quot;: &quot;Lost Civilization&quot;,
                    &quot;slug&quot;: &quot;lost-civilization&quot;
                },
                {
                    &quot;id&quot;: 136,
                    &quot;name&quot;: &quot;Artificial Intelligence&quot;,
                    &quot;slug&quot;: &quot;artificial-intelligence&quot;
                },
                {
                    &quot;id&quot;: 156,
                    &quot;name&quot;: &quot;Ecchi&quot;,
                    &quot;slug&quot;: &quot;ecchi&quot;
                },
                {
                    &quot;id&quot;: 157,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 158,
                    &quot;name&quot;: &quot;Gangs&quot;,
                    &quot;slug&quot;: &quot;gangs&quot;
                },
                {
                    &quot;id&quot;: 159,
                    &quot;name&quot;: &quot;POV&quot;,
                    &quot;slug&quot;: &quot;pov&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;title&quot;: &quot;Texhnolyze&quot;,
            &quot;slug&quot;: &quot;texhnolyze-26&quot;,
            &quot;description&quot;: &quot;In a man-made underground society, descendants of a banished generation vie for control of the crumbling city of Lux. Ichise, an orphan turned prize fighter, loses a leg and an arm to satisfy an enraged fight promoter. On the brink of death he is taken in by a young woman doctor and used as a guinea pig for the next evolution of Texhnolyze. With his new limbs, Ichise is taken under the wing of Oonishi, a powerful leader of Organ, an organization with some hold on Lux. As Ichise is drawn deeper into a war for territorial control of the city, he learns of his possible future from the young girl prophet Ran, who guides him from the shadows in his darkest times. With the explosion of the warfare, Ichise must uncover the truth about Lux and fight for his survival as he realizes his destiny.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx26-ADSztyHBNO39.jpg&quot;,
            &quot;rating&quot;: &quot;7.60&quot;,
            &quot;year&quot;: 2003,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 22,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 75508,
            &quot;favorites&quot;: 2614,
            &quot;external_id&quot;: &quot;26&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Noir&quot;,
                    &quot;slug&quot;: &quot;noir&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Cyberpunk&quot;,
                    &quot;slug&quot;: &quot;cyberpunk&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;name&quot;: &quot;Terrorism&quot;,
                    &quot;slug&quot;: &quot;terrorism&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Female Protagonist&quot;,
                    &quot;slug&quot;: &quot;female-protagonist&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cyborg&quot;,
                    &quot;slug&quot;: &quot;cyborg&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;name&quot;: &quot;Drugs&quot;,
                    &quot;slug&quot;: &quot;drugs&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;Cult&quot;,
                    &quot;slug&quot;: &quot;cult&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 55,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 83,
                    &quot;name&quot;: &quot;Rape&quot;,
                    &quot;slug&quot;: &quot;rape&quot;
                },
                {
                    &quot;id&quot;: 85,
                    &quot;name&quot;: &quot;Psychological&quot;,
                    &quot;slug&quot;: &quot;psychological&quot;
                },
                {
                    &quot;id&quot;: 97,
                    &quot;name&quot;: &quot;Suicide&quot;,
                    &quot;slug&quot;: &quot;suicide&quot;
                },
                {
                    &quot;id&quot;: 100,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 118,
                    &quot;name&quot;: &quot;War&quot;,
                    &quot;slug&quot;: &quot;war&quot;
                },
                {
                    &quot;id&quot;: 120,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 122,
                    &quot;name&quot;: &quot;Lost Civilization&quot;,
                    &quot;slug&quot;: &quot;lost-civilization&quot;
                },
                {
                    &quot;id&quot;: 151,
                    &quot;name&quot;: &quot;Boxing&quot;,
                    &quot;slug&quot;: &quot;boxing&quot;
                },
                {
                    &quot;id&quot;: 157,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 158,
                    &quot;name&quot;: &quot;Gangs&quot;,
                    &quot;slug&quot;: &quot;gangs&quot;
                },
                {
                    &quot;id&quot;: 160,
                    &quot;name&quot;: &quot;Mafia&quot;,
                    &quot;slug&quot;: &quot;mafia&quot;
                },
                {
                    &quot;id&quot;: 161,
                    &quot;name&quot;: &quot;Denpa&quot;,
                    &quot;slug&quot;: &quot;denpa&quot;
                },
                {
                    &quot;id&quot;: 162,
                    &quot;name&quot;: &quot;Class Struggle&quot;,
                    &quot;slug&quot;: &quot;class-struggle&quot;
                },
                {
                    &quot;id&quot;: 163,
                    &quot;name&quot;: &quot;Disability&quot;,
                    &quot;slug&quot;: &quot;disability&quot;
                },
                {
                    &quot;id&quot;: 164,
                    &quot;name&quot;: &quot;Amputation&quot;,
                    &quot;slug&quot;: &quot;amputation&quot;
                },
                {
                    &quot;id&quot;: 165,
                    &quot;name&quot;: &quot;Afterlife&quot;,
                    &quot;slug&quot;: &quot;afterlife&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;title&quot;: &quot;Trinity Blood&quot;,
            &quot;slug&quot;: &quot;trinity-blood-27&quot;,
            &quot;description&quot;: &quot;The background is in the distant future after the destruction brought about by Armageddon. The war between the vampires and the humans continue to persist. In order to protect the humans from the vampires, the Vatican has to rely on other allies to counter the situation. The protagonist,  Abel Nightroad, is a traveling priest from the Vatican and a crusnik, a vampire that drinks the blood of vampires. He is a member of the \&quot;Ax\&quot;, a special operations group led by Cardinal Catherina Sforza. He encounters a young girl called Esther, who decides to go with him to Rome and train at the Vatican. Soon after he meets her, the order of Rozencreuz, led by Abel&#039;s twin, Cain, tries to continue the war so they can rule the world. It&#039;s up to Abel and the AX to try and stop them.&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx27-MOAaiBHHLfOY.png&quot;,
            &quot;rating&quot;: &quot;6.80&quot;,
            &quot;year&quot;: 2005,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 24,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 26377,
            &quot;favorites&quot;: 942,
            &quot;external_id&quot;: &quot;27&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;name&quot;: &quot;Terrorism&quot;,
                    &quot;slug&quot;: &quot;terrorism&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Foreign&quot;,
                    &quot;slug&quot;: &quot;foreign&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 52,
                    &quot;name&quot;: &quot;Religion&quot;,
                    &quot;slug&quot;: &quot;religion&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Horror&quot;,
                    &quot;slug&quot;: &quot;horror&quot;
                },
                {
                    &quot;id&quot;: 100,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 106,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 107,
                    &quot;name&quot;: &quot;Anachronism&quot;,
                    &quot;slug&quot;: &quot;anachronism&quot;
                },
                {
                    &quot;id&quot;: 127,
                    &quot;name&quot;: &quot;Robots&quot;,
                    &quot;slug&quot;: &quot;robots&quot;
                },
                {
                    &quot;id&quot;: 136,
                    &quot;name&quot;: &quot;Artificial Intelligence&quot;,
                    &quot;slug&quot;: &quot;artificial-intelligence&quot;
                },
                {
                    &quot;id&quot;: 166,
                    &quot;name&quot;: &quot;Vampire&quot;,
                    &quot;slug&quot;: &quot;vampire&quot;
                },
                {
                    &quot;id&quot;: 167,
                    &quot;name&quot;: &quot;Nun&quot;,
                    &quot;slug&quot;: &quot;nun&quot;
                },
                {
                    &quot;id&quot;: 168,
                    &quot;name&quot;: &quot;Aviation&quot;,
                    &quot;slug&quot;: &quot;aviation&quot;
                },
                {
                    &quot;id&quot;: 169,
                    &quot;name&quot;: &quot;Shoujo&quot;,
                    &quot;slug&quot;: &quot;shoujo&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;title&quot;: &quot;Yakitate!! Japan&quot;,
            &quot;slug&quot;: &quot;yakitate-japan-28&quot;,
            &quot;description&quot;: &quot;Kazuma Azuma wants to make bread. Not just any kind of bread, though. He wants to make a bread that represents Japan itself and can stand toe-to-toe with rice as a national food. Thanks to his legendary \&quot;Hands of the Sun,\&quot; unnaturally warm hands that allow dough to ferment faster, Kazuma&#039;s bread is like a slice of Heaven.&lt;br&gt;\n&lt;br&gt;\nAnd when the Pantasia Rookie Competition arrives, everyone will get a taste of his skill! Along with his friend Kawachi (who&#039;s only in it for the dough), he&rsquo;ll go up against koala karate masters, Harvard bread scientists, samurai with rolling-pin swords, and more! Can Kazuma create bread like naan other and bake his way to glory, or should he quit before he&#039;s toast?&lt;br&gt;\n&lt;br&gt;\n(Source: Right Stuf)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx28-QuKcZpUjTXzV.png&quot;,
            &quot;rating&quot;: &quot;7.60&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 69,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 18755,
            &quot;favorites&quot;: 300,
            &quot;external_id&quot;: &quot;28&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Magic&quot;,
                    &quot;slug&quot;: &quot;magic&quot;
                },
                {
                    &quot;id&quot;: 126,
                    &quot;name&quot;: &quot;Food&quot;,
                    &quot;slug&quot;: &quot;food&quot;
                },
                {
                    &quot;id&quot;: 142,
                    &quot;name&quot;: &quot;Time Manipulation&quot;,
                    &quot;slug&quot;: &quot;time-manipulation&quot;
                },
                {
                    &quot;id&quot;: 153,
                    &quot;name&quot;: &quot;Parody&quot;,
                    &quot;slug&quot;: &quot;parody&quot;
                },
                {
                    &quot;id&quot;: 170,
                    &quot;name&quot;: &quot;Meta&quot;,
                    &quot;slug&quot;: &quot;meta&quot;
                },
                {
                    &quot;id&quot;: 171,
                    &quot;name&quot;: &quot;Surreal Comedy&quot;,
                    &quot;slug&quot;: &quot;surreal-comedy&quot;
                },
                {
                    &quot;id&quot;: 172,
                    &quot;name&quot;: &quot;Isekai&quot;,
                    &quot;slug&quot;: &quot;isekai&quot;
                },
                {
                    &quot;id&quot;: 173,
                    &quot;name&quot;: &quot;Educational&quot;,
                    &quot;slug&quot;: &quot;educational&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        },
        {
            &quot;id&quot;: 21,
            &quot;title&quot;: &quot;Zipang&quot;,
            &quot;slug&quot;: &quot;zipang-29&quot;,
            &quot;description&quot;: &quot;Mirai, an improved Kongou-class Aegis guided missile destroyer, is one of the newest and most advanced ships in the entire Japanese Self Defense Force (SDF). Her crew, also one of the newest, is lead by Capt. Umezu Saburo and Executive Officer Kadomatsu Yosuke. While running scheduled training exercises one day, Mirai encounters a fierce storm that throws their navigation systems into temporary disarray. After a few minutes of recovery, the crew is shocked to discover that they&#039;ve been transported back in time to June 4, 1942&amp;mdash;The Battle of Midway, during World War II. Letting history take its course for this battle, they manage to avoid the conflict firsthand and make a vow to remain annonymous, changing history as little as possible. However, when the crew comes across the dying Lt. Commander Kusaka Takumi, XO. Kadomatsu&#039;s instincts to save lives takes over, changing the course of history more than he could&#039;ve imagined.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx29-0PsnJVadMG7k.jpg&quot;,
            &quot;rating&quot;: &quot;7.10&quot;,
            &quot;year&quot;: 2004,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 26,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 6052,
            &quot;favorites&quot;: 64,
            &quot;external_id&quot;: &quot;29&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 40,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 82,
                    &quot;name&quot;: &quot;Seinen&quot;,
                    &quot;slug&quot;: &quot;seinen&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Historical&quot;,
                    &quot;slug&quot;: &quot;historical&quot;
                },
                {
                    &quot;id&quot;: 107,
                    &quot;name&quot;: &quot;Anachronism&quot;,
                    &quot;slug&quot;: &quot;anachronism&quot;
                },
                {
                    &quot;id&quot;: 117,
                    &quot;name&quot;: &quot;Ships&quot;,
                    &quot;slug&quot;: &quot;ships&quot;
                },
                {
                    &quot;id&quot;: 118,
                    &quot;name&quot;: &quot;War&quot;,
                    &quot;slug&quot;: &quot;war&quot;
                },
                {
                    &quot;id&quot;: 142,
                    &quot;name&quot;: &quot;Time Manipulation&quot;,
                    &quot;slug&quot;: &quot;time-manipulation&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T09:33:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:05.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=1&quot;,
        &quot;last&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=1094&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1094,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=7&quot;,
                &quot;label&quot;: &quot;7&quot;,
                &quot;page&quot;: 7,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=8&quot;,
                &quot;label&quot;: &quot;8&quot;,
                &quot;page&quot;: 8,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=9&quot;,
                &quot;label&quot;: &quot;9&quot;,
                &quot;page&quot;: 9,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=10&quot;,
                &quot;label&quot;: &quot;10&quot;,
                &quot;page&quot;: 10,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;...&quot;,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=1093&quot;,
                &quot;label&quot;: &quot;1093&quot;,
                &quot;page&quot;: 1093,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=1094&quot;,
                &quot;label&quot;: &quot;1094&quot;,
                &quot;page&quot;: 1094,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime&quot;,
        &quot;per_page&quot;: 20,
        &quot;to&quot;: 20,
        &quot;total&quot;: 21864
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-anime" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-anime"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-anime"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-anime" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-anime">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-anime" data-method="GET"
      data-path="api/v1/public/anime"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-anime', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-anime"
                    onclick="tryItOut('GETapi-v1-public-anime');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-anime"
                    onclick="cancelTryOut('GETapi-v1-public-anime');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-anime"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/anime</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-anime"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-anime"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-public-episodes-translators">GET api/v1/public/episodes/translators</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-episodes-translators">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes/translators" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes/translators"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-episodes-translators">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Люб. Одноголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ancord&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Persona99&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-episodes-translators" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-episodes-translators"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-episodes-translators"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-episodes-translators" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-episodes-translators">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-episodes-translators" data-method="GET"
      data-path="api/v1/public/episodes/translators"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-episodes-translators', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-episodes-translators"
                    onclick="tryItOut('GETapi-v1-public-episodes-translators');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-episodes-translators"
                    onclick="cancelTryOut('GETapi-v1-public-episodes-translators');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-episodes-translators"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/episodes/translators</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-episodes-translators"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-episodes-translators"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-public-episodes">GET api/v1/public/episodes</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-episodes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-episodes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 1,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757652/fb2ff431ebe0d42a9829b5ea07f2183d/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 2,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757653/830ce6fd979c58cde8c675e07f10199d/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 3,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757654/5fc08508d8c8eb4b6288ff157a785789/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 4,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757655/409323faa27bd9abf50f057a9effed88/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 5,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757656/e6ddbd9918910afc0f42440d909b2e6c/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 6,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757657/6ce66ff386dd1e61754f0d8509f14c5e/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 7,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757658/9875a8b9ff0dad3bcb4e5ac30e0f0c39/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 8,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757659/2c9c6fa5988a7d1cd11bf71ad022e494/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 9,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757660/482edb57db55d1dc168be51b45369d0b/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 10,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757661/995c0dee43413d7c0d44d727d61737d9/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 11,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757662/e304d4d1ca5f63ba9fc22fb30e418a56/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 12,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757663/793503e1d48b72369370d714cdce8f21/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 13,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 13,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757664/686bb487969688f11546abacf0dc6961/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 14,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757665/f644efe7e0d49568eacad12930642efa/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 15,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757666/2859269875b63a785eacd374f78c2b57/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 16,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757667/0fea4c597bce9619010bd6acc51e48e1/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 17,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757668/a7023f6c89d1b8683ada81ea8bacd90a/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 18,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757669/368db45ff85851e70fc0277c70617f57/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 19,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757670/25c9c0bcef01c52b7599699e02060458/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;anime_id&quot;: 2,
            &quot;episode_number&quot;: 20,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;//kodik.info/seria/757671/f08f84eedf55a4bd5d60a4e960536d3d/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;,
            &quot;quality&quot;: &quot;BDRip 720p&quot;,
            &quot;source&quot;: &quot;kodik&quot;,
            &quot;external_id&quot;: null,
            &quot;external_episode_id&quot;: null,
            &quot;aired_at&quot;: null,
            &quot;release_date&quot;: null,
            &quot;duration&quot;: null,
            &quot;thumbnail_url&quot;: null,
            &quot;poster_url&quot;: null,
            &quot;priority&quot;: 50,
            &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
        }
    ],
    &quot;first_page_url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 23,
    &quot;last_page_url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=23&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;page&quot;: 1,
            &quot;active&quot;: true
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=2&quot;,
            &quot;label&quot;: &quot;2&quot;,
            &quot;page&quot;: 2,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=3&quot;,
            &quot;label&quot;: &quot;3&quot;,
            &quot;page&quot;: 3,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=4&quot;,
            &quot;label&quot;: &quot;4&quot;,
            &quot;page&quot;: 4,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=5&quot;,
            &quot;label&quot;: &quot;5&quot;,
            &quot;page&quot;: 5,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=6&quot;,
            &quot;label&quot;: &quot;6&quot;,
            &quot;page&quot;: 6,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=7&quot;,
            &quot;label&quot;: &quot;7&quot;,
            &quot;page&quot;: 7,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=8&quot;,
            &quot;label&quot;: &quot;8&quot;,
            &quot;page&quot;: 8,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=9&quot;,
            &quot;label&quot;: &quot;9&quot;,
            &quot;page&quot;: 9,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=10&quot;,
            &quot;label&quot;: &quot;10&quot;,
            &quot;page&quot;: 10,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;...&quot;,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=22&quot;,
            &quot;label&quot;: &quot;22&quot;,
            &quot;page&quot;: 22,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=23&quot;,
            &quot;label&quot;: &quot;23&quot;,
            &quot;page&quot;: 23,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=2&quot;,
            &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
            &quot;page&quot;: 2,
            &quot;active&quot;: false
        }
    ],
    &quot;next_page_url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes?page=2&quot;,
    &quot;path&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes&quot;,
    &quot;per_page&quot;: 20,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 20,
    &quot;total&quot;: 449
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-episodes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-episodes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-episodes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-episodes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-episodes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-episodes" data-method="GET"
      data-path="api/v1/public/episodes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-episodes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-episodes"
                    onclick="tryItOut('GETapi-v1-public-episodes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-episodes"
                    onclick="cancelTryOut('GETapi-v1-public-episodes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-episodes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/episodes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-episodes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-episodes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-public-tags">GET api/v1/public/tags</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-tags">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/tags" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/tags"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-tags">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 409,
            &quot;name&quot;: &quot;4-koma&quot;,
            &quot;slug&quot;: &quot;4-koma&quot;
        },
        {
            &quot;id&quot;: 323,
            &quot;name&quot;: &quot;Achromatic&quot;,
            &quot;slug&quot;: &quot;achromatic&quot;
        },
        {
            &quot;id&quot;: 182,
            &quot;name&quot;: &quot;Achronological Order&quot;,
            &quot;slug&quot;: &quot;achronological-order&quot;
        },
        {
            &quot;id&quot;: 50,
            &quot;name&quot;: &quot;Acrobatics&quot;,
            &quot;slug&quot;: &quot;acrobatics&quot;
        },
        {
            &quot;id&quot;: 320,
            &quot;name&quot;: &quot;Acting&quot;,
            &quot;slug&quot;: &quot;acting&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Action&quot;,
            &quot;slug&quot;: &quot;action&quot;
        },
        {
            &quot;id&quot;: 90,
            &quot;name&quot;: &quot;Adoption&quot;,
            &quot;slug&quot;: &quot;adoption&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Adventure&quot;,
            &quot;slug&quot;: &quot;adventure&quot;
        },
        {
            &quot;id&quot;: 386,
            &quot;name&quot;: &quot;Advertisement&quot;,
            &quot;slug&quot;: &quot;advertisement&quot;
        },
        {
            &quot;id&quot;: 165,
            &quot;name&quot;: &quot;Afterlife&quot;,
            &quot;slug&quot;: &quot;afterlife&quot;
        },
        {
            &quot;id&quot;: 213,
            &quot;name&quot;: &quot;Age Gap&quot;,
            &quot;slug&quot;: &quot;age-gap&quot;
        },
        {
            &quot;id&quot;: 282,
            &quot;name&quot;: &quot;Age Regression&quot;,
            &quot;slug&quot;: &quot;age-regression&quot;
        },
        {
            &quot;id&quot;: 314,
            &quot;name&quot;: &quot;Agender&quot;,
            &quot;slug&quot;: &quot;agender&quot;
        },
        {
            &quot;id&quot;: 234,
            &quot;name&quot;: &quot;Agriculture&quot;,
            &quot;slug&quot;: &quot;agriculture&quot;
        },
        {
            &quot;id&quot;: 395,
            &quot;name&quot;: &quot;Ahegao&quot;,
            &quot;slug&quot;: &quot;ahegao&quot;
        },
        {
            &quot;id&quot;: 318,
            &quot;name&quot;: &quot;Airsoft&quot;,
            &quot;slug&quot;: &quot;airsoft&quot;
        },
        {
            &quot;id&quot;: 250,
            &quot;name&quot;: &quot;Alchemy&quot;,
            &quot;slug&quot;: &quot;alchemy&quot;
        },
        {
            &quot;id&quot;: 48,
            &quot;name&quot;: &quot;Aliens&quot;,
            &quot;slug&quot;: &quot;aliens&quot;
        },
        {
            &quot;id&quot;: 220,
            &quot;name&quot;: &quot;Alternate Universe&quot;,
            &quot;slug&quot;: &quot;alternate-universe&quot;
        },
        {
            &quot;id&quot;: 65,
            &quot;name&quot;: &quot;American Football&quot;,
            &quot;slug&quot;: &quot;american-football&quot;
        },
        {
            &quot;id&quot;: 25,
            &quot;name&quot;: &quot;Amnesia&quot;,
            &quot;slug&quot;: &quot;amnesia&quot;
        },
        {
            &quot;id&quot;: 164,
            &quot;name&quot;: &quot;Amputation&quot;,
            &quot;slug&quot;: &quot;amputation&quot;
        },
        {
            &quot;id&quot;: 107,
            &quot;name&quot;: &quot;Anachronism&quot;,
            &quot;slug&quot;: &quot;anachronism&quot;
        },
        {
            &quot;id&quot;: 295,
            &quot;name&quot;: &quot;Anal Sex&quot;,
            &quot;slug&quot;: &quot;anal-sex&quot;
        },
        {
            &quot;id&quot;: 253,
            &quot;name&quot;: &quot;Ancient China&quot;,
            &quot;slug&quot;: &quot;ancient-china&quot;
        },
        {
            &quot;id&quot;: 147,
            &quot;name&quot;: &quot;Angels&quot;,
            &quot;slug&quot;: &quot;angels&quot;
        },
        {
            &quot;id&quot;: 129,
            &quot;name&quot;: &quot;Animals&quot;,
            &quot;slug&quot;: &quot;animals&quot;
        },
        {
            &quot;id&quot;: 364,
            &quot;name&quot;: &quot;Anthology&quot;,
            &quot;slug&quot;: &quot;anthology&quot;
        },
        {
            &quot;id&quot;: 114,
            &quot;name&quot;: &quot;Anthropomorphism&quot;,
            &quot;slug&quot;: &quot;anthropomorphism&quot;
        },
        {
            &quot;id&quot;: 13,
            &quot;name&quot;: &quot;Anti-Hero&quot;,
            &quot;slug&quot;: &quot;anti-hero&quot;
        },
        {
            &quot;id&quot;: 188,
            &quot;name&quot;: &quot;Archery&quot;,
            &quot;slug&quot;: &quot;archery&quot;
        },
        {
            &quot;id&quot;: 426,
            &quot;name&quot;: &quot;Armpits&quot;,
            &quot;slug&quot;: &quot;armpits&quot;
        },
        {
            &quot;id&quot;: 139,
            &quot;name&quot;: &quot;Aromantic&quot;,
            &quot;slug&quot;: &quot;aromantic&quot;
        },
        {
            &quot;id&quot;: 140,
            &quot;name&quot;: &quot;Arranged Marriage&quot;,
            &quot;slug&quot;: &quot;arranged-marriage&quot;
        },
        {
            &quot;id&quot;: 136,
            &quot;name&quot;: &quot;Artificial Intelligence&quot;,
            &quot;slug&quot;: &quot;artificial-intelligence&quot;
        },
        {
            &quot;id&quot;: 132,
            &quot;name&quot;: &quot;Asexual&quot;,
            &quot;slug&quot;: &quot;asexual&quot;
        },
        {
            &quot;id&quot;: 396,
            &quot;name&quot;: &quot;Ashikoki&quot;,
            &quot;slug&quot;: &quot;ashikoki&quot;
        },
        {
            &quot;id&quot;: 424,
            &quot;name&quot;: &quot;Asphyxiation&quot;,
            &quot;slug&quot;: &quot;asphyxiation&quot;
        },
        {
            &quot;id&quot;: 112,
            &quot;name&quot;: &quot;Assassins&quot;,
            &quot;slug&quot;: &quot;assassins&quot;
        },
        {
            &quot;id&quot;: 321,
            &quot;name&quot;: &quot;Astronomy&quot;,
            &quot;slug&quot;: &quot;astronomy&quot;
        },
        {
            &quot;id&quot;: 264,
            &quot;name&quot;: &quot;Athletics&quot;,
            &quot;slug&quot;: &quot;athletics&quot;
        },
        {
            &quot;id&quot;: 262,
            &quot;name&quot;: &quot;Augmented Reality&quot;,
            &quot;slug&quot;: &quot;augmented-reality&quot;
        },
        {
            &quot;id&quot;: 362,
            &quot;name&quot;: &quot;Autobiographical&quot;,
            &quot;slug&quot;: &quot;autobiographical&quot;
        },
        {
            &quot;id&quot;: 168,
            &quot;name&quot;: &quot;Aviation&quot;,
            &quot;slug&quot;: &quot;aviation&quot;
        },
        {
            &quot;id&quot;: 249,
            &quot;name&quot;: &quot;Badminton&quot;,
            &quot;slug&quot;: &quot;badminton&quot;
        },
        {
            &quot;id&quot;: 373,
            &quot;name&quot;: &quot;Ballet&quot;,
            &quot;slug&quot;: &quot;ballet&quot;
        },
        {
            &quot;id&quot;: 184,
            &quot;name&quot;: &quot;Band&quot;,
            &quot;slug&quot;: &quot;band&quot;
        },
        {
            &quot;id&quot;: 59,
            &quot;name&quot;: &quot;Bar&quot;,
            &quot;slug&quot;: &quot;bar&quot;
        },
        {
            &quot;id&quot;: 209,
            &quot;name&quot;: &quot;Baseball&quot;,
            &quot;slug&quot;: &quot;baseball&quot;
        },
        {
            &quot;id&quot;: 276,
            &quot;name&quot;: &quot;Basketball&quot;,
            &quot;slug&quot;: &quot;basketball&quot;
        },
        {
            &quot;id&quot;: 113,
            &quot;name&quot;: &quot;Battle Royale&quot;,
            &quot;slug&quot;: &quot;battle-royale&quot;
        },
        {
            &quot;id&quot;: 385,
            &quot;name&quot;: &quot;Biographical&quot;,
            &quot;slug&quot;: &quot;biographical&quot;
        },
        {
            &quot;id&quot;: 180,
            &quot;name&quot;: &quot;Bisexual&quot;,
            &quot;slug&quot;: &quot;bisexual&quot;
        },
        {
            &quot;id&quot;: 299,
            &quot;name&quot;: &quot;Blackmail&quot;,
            &quot;slug&quot;: &quot;blackmail&quot;
        },
        {
            &quot;id&quot;: 259,
            &quot;name&quot;: &quot;Board Game&quot;,
            &quot;slug&quot;: &quot;board-game&quot;
        },
        {
            &quot;id&quot;: 272,
            &quot;name&quot;: &quot;Boarding School&quot;,
            &quot;slug&quot;: &quot;boarding-school&quot;
        },
        {
            &quot;id&quot;: 53,
            &quot;name&quot;: &quot;Body Horror&quot;,
            &quot;slug&quot;: &quot;body-horror&quot;
        },
        {
            &quot;id&quot;: 331,
            &quot;name&quot;: &quot;Body Image&quot;,
            &quot;slug&quot;: &quot;body-image&quot;
        },
        {
            &quot;id&quot;: 322,
            &quot;name&quot;: &quot;Body Swapping&quot;,
            &quot;slug&quot;: &quot;body-swapping&quot;
        },
        {
            &quot;id&quot;: 269,
            &quot;name&quot;: &quot;Bondage&quot;,
            &quot;slug&quot;: &quot;bondage&quot;
        },
        {
            &quot;id&quot;: 377,
            &quot;name&quot;: &quot;Boobjob&quot;,
            &quot;slug&quot;: &quot;boobjob&quot;
        },
        {
            &quot;id&quot;: 309,
            &quot;name&quot;: &quot;Bowling&quot;,
            &quot;slug&quot;: &quot;bowling&quot;
        },
        {
            &quot;id&quot;: 151,
            &quot;name&quot;: &quot;Boxing&quot;,
            &quot;slug&quot;: &quot;boxing&quot;
        },
        {
            &quot;id&quot;: 181,
            &quot;name&quot;: &quot;Boys&#039; Love&quot;,
            &quot;slug&quot;: &quot;boys-love&quot;
        },
        {
            &quot;id&quot;: 70,
            &quot;name&quot;: &quot;Bullying&quot;,
            &quot;slug&quot;: &quot;bullying&quot;
        },
        {
            &quot;id&quot;: 155,
            &quot;name&quot;: &quot;Butler&quot;,
            &quot;slug&quot;: &quot;butler&quot;
        },
        {
            &quot;id&quot;: 289,
            &quot;name&quot;: &quot;Calligraphy&quot;,
            &quot;slug&quot;: &quot;calligraphy&quot;
        },
        {
            &quot;id&quot;: 360,
            &quot;name&quot;: &quot;Camping&quot;,
            &quot;slug&quot;: &quot;camping&quot;
        },
        {
            &quot;id&quot;: 328,
            &quot;name&quot;: &quot;Cannibalism&quot;,
            &quot;slug&quot;: &quot;cannibalism&quot;
        },
        {
            &quot;id&quot;: 260,
            &quot;name&quot;: &quot;Card Battle&quot;,
            &quot;slug&quot;: &quot;card-battle&quot;
        },
        {
            &quot;id&quot;: 81,
            &quot;name&quot;: &quot;Cars&quot;,
            &quot;slug&quot;: &quot;cars&quot;
        },
        {
            &quot;id&quot;: 327,
            &quot;name&quot;: &quot;Centaur&quot;,
            &quot;slug&quot;: &quot;centaur&quot;
        },
        {
            &quot;id&quot;: 422,
            &quot;name&quot;: &quot;Cervix Penetration&quot;,
            &quot;slug&quot;: &quot;cervix-penetration&quot;
        },
        {
            &quot;id&quot;: 35,
            &quot;name&quot;: &quot;CGI&quot;,
            &quot;slug&quot;: &quot;cgi&quot;
        },
        {
            &quot;id&quot;: 354,
            &quot;name&quot;: &quot;Cheating&quot;,
            &quot;slug&quot;: &quot;cheating&quot;
        },
        {
            &quot;id&quot;: 363,
            &quot;name&quot;: &quot;Cheerleading&quot;,
            &quot;slug&quot;: &quot;cheerleading&quot;
        },
        {
            &quot;id&quot;: 78,
            &quot;name&quot;: &quot;Chibi&quot;,
            &quot;slug&quot;: &quot;chibi&quot;
        },
        {
            &quot;id&quot;: 204,
            &quot;name&quot;: &quot;Chimera&quot;,
            &quot;slug&quot;: &quot;chimera&quot;
        },
        {
            &quot;id&quot;: 342,
            &quot;name&quot;: &quot;Chuunibyou&quot;,
            &quot;slug&quot;: &quot;chuunibyou&quot;
        },
        {
            &quot;id&quot;: 34,
            &quot;name&quot;: &quot;Circus&quot;,
            &quot;slug&quot;: &quot;circus&quot;
        },
        {
            &quot;id&quot;: 162,
            &quot;name&quot;: &quot;Class Struggle&quot;,
            &quot;slug&quot;: &quot;class-struggle&quot;
        },
        {
            &quot;id&quot;: 232,
            &quot;name&quot;: &quot;Classic Literature&quot;,
            &quot;slug&quot;: &quot;classic-literature&quot;
        },
        {
            &quot;id&quot;: 344,
            &quot;name&quot;: &quot;Classical Music&quot;,
            &quot;slug&quot;: &quot;classical-music&quot;
        },
        {
            &quot;id&quot;: 143,
            &quot;name&quot;: &quot;Clone&quot;,
            &quot;slug&quot;: &quot;clone&quot;
        },
        {
            &quot;id&quot;: 222,
            &quot;name&quot;: &quot;Coastal&quot;,
            &quot;slug&quot;: &quot;coastal&quot;
        },
        {
            &quot;id&quot;: 197,
            &quot;name&quot;: &quot;Cohabitation&quot;,
            &quot;slug&quot;: &quot;cohabitation&quot;
        },
        {
            &quot;id&quot;: 74,
            &quot;name&quot;: &quot;College&quot;,
            &quot;slug&quot;: &quot;college&quot;
        },
        {
            &quot;id&quot;: 41,
            &quot;name&quot;: &quot;Comedy&quot;,
            &quot;slug&quot;: &quot;comedy&quot;
        },
        {
            &quot;id&quot;: 69,
            &quot;name&quot;: &quot;Coming of Age&quot;,
            &quot;slug&quot;: &quot;coming-of-age&quot;
        },
        {
            &quot;id&quot;: 55,
            &quot;name&quot;: &quot;Conspiracy&quot;,
            &quot;slug&quot;: &quot;conspiracy&quot;
        },
        {
            &quot;id&quot;: 177,
            &quot;name&quot;: &quot;Cosmic Horror&quot;,
            &quot;slug&quot;: &quot;cosmic-horror&quot;
        },
        {
            &quot;id&quot;: 296,
            &quot;name&quot;: &quot;Cosplay&quot;,
            &quot;slug&quot;: &quot;cosplay&quot;
        },
        {
            &quot;id&quot;: 27,
            &quot;name&quot;: &quot;Cowboys&quot;,
            &quot;slug&quot;: &quot;cowboys&quot;
        },
        {
            &quot;id&quot;: 358,
            &quot;name&quot;: &quot;Creature Taming&quot;,
            &quot;slug&quot;: &quot;creature-taming&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Crime&quot;,
            &quot;slug&quot;: &quot;crime&quot;
        },
        {
            &quot;id&quot;: 104,
            &quot;name&quot;: &quot;Criminal Organization&quot;,
            &quot;slug&quot;: &quot;criminal-organization&quot;
        },
        {
            &quot;id&quot;: 99,
            &quot;name&quot;: &quot;Crossdressing&quot;,
            &quot;slug&quot;: &quot;crossdressing&quot;
        },
        {
            &quot;id&quot;: 233,
            &quot;name&quot;: &quot;Crossover&quot;,
            &quot;slug&quot;: &quot;crossover&quot;
        },
        {
            &quot;id&quot;: 33,
            &quot;name&quot;: &quot;Cult&quot;,
            &quot;slug&quot;: &quot;cult&quot;
        },
        {
            &quot;id&quot;: 152,
            &quot;name&quot;: &quot;Cultivation&quot;,
            &quot;slug&quot;: &quot;cultivation&quot;
        },
        {
            &quot;id&quot;: 387,
            &quot;name&quot;: &quot;Cumflation&quot;,
            &quot;slug&quot;: &quot;cumflation&quot;
        },
        {
            &quot;id&quot;: 301,
            &quot;name&quot;: &quot;Cunnilingus&quot;,
            &quot;slug&quot;: &quot;cunnilingus&quot;
        },
        {
            &quot;id&quot;: 189,
            &quot;name&quot;: &quot;Curses&quot;,
            &quot;slug&quot;: &quot;curses&quot;
        },
        {
            &quot;id&quot;: 230,
            &quot;name&quot;: &quot;Cute Boys Doing Cute Things&quot;,
            &quot;slug&quot;: &quot;cute-boys-doing-cute-things&quot;
        },
        {
            &quot;id&quot;: 219,
            &quot;name&quot;: &quot;Cute Girls Doing Cute Things&quot;,
            &quot;slug&quot;: &quot;cute-girls-doing-cute-things&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;name&quot;: &quot;Cyberpunk&quot;,
            &quot;slug&quot;: &quot;cyberpunk&quot;
        },
        {
            &quot;id&quot;: 23,
            &quot;name&quot;: &quot;Cyborg&quot;,
            &quot;slug&quot;: &quot;cyborg&quot;
        },
        {
            &quot;id&quot;: 325,
            &quot;name&quot;: &quot;Cycling&quot;,
            &quot;slug&quot;: &quot;cycling&quot;
        },
        {
            &quot;id&quot;: 240,
            &quot;name&quot;: &quot;Dancing&quot;,
            &quot;slug&quot;: &quot;dancing&quot;
        },
        {
            &quot;id&quot;: 261,
            &quot;name&quot;: &quot;Death Game&quot;,
            &quot;slug&quot;: &quot;death-game&quot;
        },
        {
            &quot;id&quot;: 397,
            &quot;name&quot;: &quot;Deepthroat&quot;,
            &quot;slug&quot;: &quot;deepthroat&quot;
        },
        {
            &quot;id&quot;: 348,
            &quot;name&quot;: &quot;Defloration&quot;,
            &quot;slug&quot;: &quot;defloration&quot;
        },
        {
            &quot;id&quot;: 71,
            &quot;name&quot;: &quot;Delinquents&quot;,
            &quot;slug&quot;: &quot;delinquents&quot;
        },
        {
            &quot;id&quot;: 137,
            &quot;name&quot;: &quot;Demons&quot;,
            &quot;slug&quot;: &quot;demons&quot;
        },
        {
            &quot;id&quot;: 161,
            &quot;name&quot;: &quot;Denpa&quot;,
            &quot;slug&quot;: &quot;denpa&quot;
        },
        {
            &quot;id&quot;: 44,
            &quot;name&quot;: &quot;Desert&quot;,
            &quot;slug&quot;: &quot;desert&quot;
        },
        {
            &quot;id&quot;: 87,
            &quot;name&quot;: &quot;Detective&quot;,
            &quot;slug&quot;: &quot;detective&quot;
        },
        {
            &quot;id&quot;: 308,
            &quot;name&quot;: &quot;DILF&quot;,
            &quot;slug&quot;: &quot;dilf&quot;
        },
        {
            &quot;id&quot;: 243,
            &quot;name&quot;: &quot;Dinosaurs&quot;,
            &quot;slug&quot;: &quot;dinosaurs&quot;
        },
        {
            &quot;id&quot;: 163,
            &quot;name&quot;: &quot;Disability&quot;,
            &quot;slug&quot;: &quot;disability&quot;
        },
        {
            &quot;id&quot;: 92,
            &quot;name&quot;: &quot;Dissociative Identities&quot;,
            &quot;slug&quot;: &quot;dissociative-identities&quot;
        },
        {
            &quot;id&quot;: 307,
            &quot;name&quot;: &quot;Double Penetration&quot;,
            &quot;slug&quot;: &quot;double-penetration&quot;
        },
        {
            &quot;id&quot;: 131,
            &quot;name&quot;: &quot;Dragons&quot;,
            &quot;slug&quot;: &quot;dragons&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Drama&quot;,
            &quot;slug&quot;: &quot;drama&quot;
        },
        {
            &quot;id&quot;: 79,
            &quot;name&quot;: &quot;Drawing&quot;,
            &quot;slug&quot;: &quot;drawing&quot;
        },
        {
            &quot;id&quot;: 29,
            &quot;name&quot;: &quot;Drugs&quot;,
            &quot;slug&quot;: &quot;drugs&quot;
        },
        {
            &quot;id&quot;: 255,
            &quot;name&quot;: &quot;Dullahan&quot;,
            &quot;slug&quot;: &quot;dullahan&quot;
        },
        {
            &quot;id&quot;: 194,
            &quot;name&quot;: &quot;Dungeon&quot;,
            &quot;slug&quot;: &quot;dungeon&quot;
        },
        {
            &quot;id&quot;: 120,
            &quot;name&quot;: &quot;Dystopian&quot;,
            &quot;slug&quot;: &quot;dystopian&quot;
        },
        {
            &quot;id&quot;: 404,
            &quot;name&quot;: &quot;E-Sports&quot;,
            &quot;slug&quot;: &quot;e-sports&quot;
        },
        {
            &quot;id&quot;: 156,
            &quot;name&quot;: &quot;Ecchi&quot;,
            &quot;slug&quot;: &quot;ecchi&quot;
        },
        {
            &quot;id&quot;: 274,
            &quot;name&quot;: &quot;Eco-Horror&quot;,
            &quot;slug&quot;: &quot;eco-horror&quot;
        },
        {
            &quot;id&quot;: 283,
            &quot;name&quot;: &quot;Economics&quot;,
            &quot;slug&quot;: &quot;economics&quot;
        },
        {
            &quot;id&quot;: 173,
            &quot;name&quot;: &quot;Educational&quot;,
            &quot;slug&quot;: &quot;educational&quot;
        },
        {
            &quot;id&quot;: 333,
            &quot;name&quot;: &quot;Elderly Protagonist&quot;,
            &quot;slug&quot;: &quot;elderly-protagonist&quot;
        },
        {
            &quot;id&quot;: 291,
            &quot;name&quot;: &quot;Elf&quot;,
            &quot;slug&quot;: &quot;elf&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Ensemble Cast&quot;,
            &quot;slug&quot;: &quot;ensemble-cast&quot;
        },
        {
            &quot;id&quot;: 228,
            &quot;name&quot;: &quot;Environmental&quot;,
            &quot;slug&quot;: &quot;environmental&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;Episodic&quot;,
            &quot;slug&quot;: &quot;episodic&quot;
        },
        {
            &quot;id&quot;: 381,
            &quot;name&quot;: &quot;Ero Guro&quot;,
            &quot;slug&quot;: &quot;ero-guro&quot;
        },
        {
            &quot;id&quot;: 133,
            &quot;name&quot;: &quot;Espionage&quot;,
            &quot;slug&quot;: &quot;espionage&quot;
        },
        {
            &quot;id&quot;: 110,
            &quot;name&quot;: &quot;Estranged Family&quot;,
            &quot;slug&quot;: &quot;estranged-family&quot;
        },
        {
            &quot;id&quot;: 405,
            &quot;name&quot;: &quot;Exhibitionism&quot;,
            &quot;slug&quot;: &quot;exhibitionism&quot;
        },
        {
            &quot;id&quot;: 214,
            &quot;name&quot;: &quot;Exorcism&quot;,
            &quot;slug&quot;: &quot;exorcism&quot;
        },
        {
            &quot;id&quot;: 279,
            &quot;name&quot;: &quot;Facial&quot;,
            &quot;slug&quot;: &quot;facial&quot;
        },
        {
            &quot;id&quot;: 138,
            &quot;name&quot;: &quot;Fairy&quot;,
            &quot;slug&quot;: &quot;fairy&quot;
        },
        {
            &quot;id&quot;: 238,
            &quot;name&quot;: &quot;Fairy Tale&quot;,
            &quot;slug&quot;: &quot;fairy-tale&quot;
        },
        {
            &quot;id&quot;: 420,
            &quot;name&quot;: &quot;Fake Relationship&quot;,
            &quot;slug&quot;: &quot;fake-relationship&quot;
        },
        {
            &quot;id&quot;: 218,
            &quot;name&quot;: &quot;Family Life&quot;,
            &quot;slug&quot;: &quot;family-life&quot;
        },
        {
            &quot;id&quot;: 61,
            &quot;name&quot;: &quot;Fantasy&quot;,
            &quot;slug&quot;: &quot;fantasy&quot;
        },
        {
            &quot;id&quot;: 313,
            &quot;name&quot;: &quot;Fashion&quot;,
            &quot;slug&quot;: &quot;fashion&quot;
        },
        {
            &quot;id&quot;: 399,
            &quot;name&quot;: &quot;Feet&quot;,
            &quot;slug&quot;: &quot;feet&quot;
        },
        {
            &quot;id&quot;: 278,
            &quot;name&quot;: &quot;Fellatio&quot;,
            &quot;slug&quot;: &quot;fellatio&quot;
        },
        {
            &quot;id&quot;: 198,
            &quot;name&quot;: &quot;Female Harem&quot;,
            &quot;slug&quot;: &quot;female-harem&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;name&quot;: &quot;Female Protagonist&quot;,
            &quot;slug&quot;: &quot;female-protagonist&quot;
        },
        {
            &quot;id&quot;: 229,
            &quot;name&quot;: &quot;Femboy&quot;,
            &quot;slug&quot;: &quot;femboy&quot;
        },
        {
            &quot;id&quot;: 334,
            &quot;name&quot;: &quot;Femdom&quot;,
            &quot;slug&quot;: &quot;femdom&quot;
        },
        {
            &quot;id&quot;: 345,
            &quot;name&quot;: &quot;Fencing&quot;,
            &quot;slug&quot;: &quot;fencing&quot;
        },
        {
            &quot;id&quot;: 352,
            &quot;name&quot;: &quot;Filmmaking&quot;,
            &quot;slug&quot;: &quot;filmmaking&quot;
        },
        {
            &quot;id&quot;: 375,
            &quot;name&quot;: &quot;Fingering&quot;,
            &quot;slug&quot;: &quot;fingering&quot;
        },
        {
            &quot;id&quot;: 412,
            &quot;name&quot;: &quot;Firefighters&quot;,
            &quot;slug&quot;: &quot;firefighters&quot;
        },
        {
            &quot;id&quot;: 346,
            &quot;name&quot;: &quot;Fishing&quot;,
            &quot;slug&quot;: &quot;fishing&quot;
        },
        {
            &quot;id&quot;: 410,
            &quot;name&quot;: &quot;Fisting&quot;,
            &quot;slug&quot;: &quot;fisting&quot;
        },
        {
            &quot;id&quot;: 324,
            &quot;name&quot;: &quot;Fitness&quot;,
            &quot;slug&quot;: &quot;fitness&quot;
        },
        {
            &quot;id&quot;: 408,
            &quot;name&quot;: &quot;Flash&quot;,
            &quot;slug&quot;: &quot;flash&quot;
        },
        {
            &quot;id&quot;: 388,
            &quot;name&quot;: &quot;Flat Chest&quot;,
            &quot;slug&quot;: &quot;flat-chest&quot;
        },
        {
            &quot;id&quot;: 126,
            &quot;name&quot;: &quot;Food&quot;,
            &quot;slug&quot;: &quot;food&quot;
        },
        {
            &quot;id&quot;: 80,
            &quot;name&quot;: &quot;Football&quot;,
            &quot;slug&quot;: &quot;football&quot;
        },
        {
            &quot;id&quot;: 39,
            &quot;name&quot;: &quot;Foreign&quot;,
            &quot;slug&quot;: &quot;foreign&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;name&quot;: &quot;Found Family&quot;,
            &quot;slug&quot;: &quot;found-family&quot;
        },
        {
            &quot;id&quot;: 42,
            &quot;name&quot;: &quot;Fugitive&quot;,
            &quot;slug&quot;: &quot;fugitive&quot;
        },
        {
            &quot;id&quot;: 203,
            &quot;name&quot;: &quot;Full CGI&quot;,
            &quot;slug&quot;: &quot;full-cgi&quot;
        },
        {
            &quot;id&quot;: 337,
            &quot;name&quot;: &quot;Futanari&quot;,
            &quot;slug&quot;: &quot;futanari&quot;
        },
        {
            &quot;id&quot;: 26,
            &quot;name&quot;: &quot;Gambling&quot;,
            &quot;slug&quot;: &quot;gambling&quot;
        },
        {
            &quot;id&quot;: 158,
            &quot;name&quot;: &quot;Gangs&quot;,
            &quot;slug&quot;: &quot;gangs&quot;
        },
        {
            &quot;id&quot;: 111,
            &quot;name&quot;: &quot;Gender Bending&quot;,
            &quot;slug&quot;: &quot;gender-bending&quot;
        },
        {
            &quot;id&quot;: 258,
            &quot;name&quot;: &quot;Ghost&quot;,
            &quot;slug&quot;: &quot;ghost&quot;
        },
        {
            &quot;id&quot;: 257,
            &quot;name&quot;: &quot;Go&quot;,
            &quot;slug&quot;: &quot;go&quot;
        },
        {
            &quot;id&quot;: 292,
            &quot;name&quot;: &quot;Goblin&quot;,
            &quot;slug&quot;: &quot;goblin&quot;
        },
        {
            &quot;id&quot;: 121,
            &quot;name&quot;: &quot;Gods&quot;,
            &quot;slug&quot;: &quot;gods&quot;
        },
        {
            &quot;id&quot;: 315,
            &quot;name&quot;: &quot;Golf&quot;,
            &quot;slug&quot;: &quot;golf&quot;
        },
        {
            &quot;id&quot;: 100,
            &quot;name&quot;: &quot;Gore&quot;,
            &quot;slug&quot;: &quot;gore&quot;
        },
        {
            &quot;id&quot;: 304,
            &quot;name&quot;: &quot;Group Sex&quot;,
            &quot;slug&quot;: &quot;group-sex&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;name&quot;: &quot;Guns&quot;,
            &quot;slug&quot;: &quot;guns&quot;
        },
        {
            &quot;id&quot;: 210,
            &quot;name&quot;: &quot;Gyaru&quot;,
            &quot;slug&quot;: &quot;gyaru&quot;
        },
        {
            &quot;id&quot;: 302,
            &quot;name&quot;: &quot;Hair Pulling&quot;,
            &quot;slug&quot;: &quot;hair-pulling&quot;
        },
        {
            &quot;id&quot;: 355,
            &quot;name&quot;: &quot;Handball&quot;,
            &quot;slug&quot;: &quot;handball&quot;
        },
        {
            &quot;id&quot;: 280,
            &quot;name&quot;: &quot;Handjob&quot;,
            &quot;slug&quot;: &quot;handjob&quot;
        },
        {
            &quot;id&quot;: 125,
            &quot;name&quot;: &quot;Henshin&quot;,
            &quot;slug&quot;: &quot;henshin&quot;
        },
        {
            &quot;id&quot;: 277,
            &quot;name&quot;: &quot;Hentai&quot;,
            &quot;slug&quot;: &quot;hentai&quot;
        },
        {
            &quot;id&quot;: 22,
            &quot;name&quot;: &quot;Heterosexual&quot;,
            &quot;slug&quot;: &quot;heterosexual&quot;
        },
        {
            &quot;id&quot;: 217,
            &quot;name&quot;: &quot;Hikikomori&quot;,
            &quot;slug&quot;: &quot;hikikomori&quot;
        },
        {
            &quot;id&quot;: 208,
            &quot;name&quot;: &quot;Hip-hop Music&quot;,
            &quot;slug&quot;: &quot;hip-hop-music&quot;
        },
        {
            &quot;id&quot;: 95,
            &quot;name&quot;: &quot;Historical&quot;,
            &quot;slug&quot;: &quot;historical&quot;
        },
        {
            &quot;id&quot;: 241,
            &quot;name&quot;: &quot;Homeless&quot;,
            &quot;slug&quot;: &quot;homeless&quot;
        },
        {
            &quot;id&quot;: 84,
            &quot;name&quot;: &quot;Horror&quot;,
            &quot;slug&quot;: &quot;horror&quot;
        },
        {
            &quot;id&quot;: 332,
            &quot;name&quot;: &quot;Horticulture&quot;,
            &quot;slug&quot;: &quot;horticulture&quot;
        },
        {
            &quot;id&quot;: 372,
            &quot;name&quot;: &quot;Human Pet&quot;,
            &quot;slug&quot;: &quot;human-pet&quot;
        },
        {
            &quot;id&quot;: 411,
            &quot;name&quot;: &quot;Hypersexuality&quot;,
            &quot;slug&quot;: &quot;hypersexuality&quot;
        },
        {
            &quot;id&quot;: 267,
            &quot;name&quot;: &quot;Ice Skating&quot;,
            &quot;slug&quot;: &quot;ice-skating&quot;
        },
        {
            &quot;id&quot;: 251,
            &quot;name&quot;: &quot;Idol&quot;,
            &quot;slug&quot;: &quot;idol&quot;
        },
        {
            &quot;id&quot;: 199,
            &quot;name&quot;: &quot;Incest&quot;,
            &quot;slug&quot;: &quot;incest&quot;
        },
        {
            &quot;id&quot;: 271,
            &quot;name&quot;: &quot;Indigenous Cultures&quot;,
            &quot;slug&quot;: &quot;indigenous-cultures&quot;
        },
        {
            &quot;id&quot;: 284,
            &quot;name&quot;: &quot;Inn&quot;,
            &quot;slug&quot;: &quot;inn&quot;
        },
        {
            &quot;id&quot;: 298,
            &quot;name&quot;: &quot;Inseki&quot;,
            &quot;slug&quot;: &quot;inseki&quot;
        },
        {
            &quot;id&quot;: 339,
            &quot;name&quot;: &quot;Irrumatio&quot;,
            &quot;slug&quot;: &quot;irrumatio&quot;
        },
        {
            &quot;id&quot;: 172,
            &quot;name&quot;: &quot;Isekai&quot;,
            &quot;slug&quot;: &quot;isekai&quot;
        },
        {
            &quot;id&quot;: 329,
            &quot;name&quot;: &quot;Iyashikei&quot;,
            &quot;slug&quot;: &quot;iyashikei&quot;
        },
        {
            &quot;id&quot;: 402,
            &quot;name&quot;: &quot;Jazz Music&quot;,
            &quot;slug&quot;: &quot;jazz-music&quot;
        },
        {
            &quot;id&quot;: 76,
            &quot;name&quot;: &quot;Josei&quot;,
            &quot;slug&quot;: &quot;josei&quot;
        },
        {
            &quot;id&quot;: 371,
            &quot;name&quot;: &quot;Judo&quot;,
            &quot;slug&quot;: &quot;judo&quot;
        },
        {
            &quot;id&quot;: 146,
            &quot;name&quot;: &quot;Kabuki&quot;,
            &quot;slug&quot;: &quot;kabuki&quot;
        },
        {
            &quot;id&quot;: 108,
            &quot;name&quot;: &quot;Kaiju&quot;,
            &quot;slug&quot;: &quot;kaiju&quot;
        },
        {
            &quot;id&quot;: 316,
            &quot;name&quot;: &quot;Karuta&quot;,
            &quot;slug&quot;: &quot;karuta&quot;
        },
        {
            &quot;id&quot;: 223,
            &quot;name&quot;: &quot;Kemonomimi&quot;,
            &quot;slug&quot;: &quot;kemonomimi&quot;
        },
        {
            &quot;id&quot;: 330,
            &quot;name&quot;: &quot;Kids&quot;,
            &quot;slug&quot;: &quot;kids&quot;
        },
        {
            &quot;id&quot;: 270,
            &quot;name&quot;: &quot;Kingdom Management&quot;,
            &quot;slug&quot;: &quot;kingdom-management&quot;
        },
        {
            &quot;id&quot;: 368,
            &quot;name&quot;: &quot;Konbini&quot;,
            &quot;slug&quot;: &quot;konbini&quot;
        },
        {
            &quot;id&quot;: 60,
            &quot;name&quot;: &quot;Kuudere&quot;,
            &quot;slug&quot;: &quot;kuudere&quot;
        },
        {
            &quot;id&quot;: 366,
            &quot;name&quot;: &quot;Lacrosse&quot;,
            &quot;slug&quot;: &quot;lacrosse&quot;
        },
        {
            &quot;id&quot;: 376,
            &quot;name&quot;: &quot;Lactation&quot;,
            &quot;slug&quot;: &quot;lactation&quot;
        },
        {
            &quot;id&quot;: 207,
            &quot;name&quot;: &quot;Language Barrier&quot;,
            &quot;slug&quot;: &quot;language-barrier&quot;
        },
        {
            &quot;id&quot;: 300,
            &quot;name&quot;: &quot;Large Breasts&quot;,
            &quot;slug&quot;: &quot;large-breasts&quot;
        },
        {
            &quot;id&quot;: 149,
            &quot;name&quot;: &quot;LGBTQ+ Themes&quot;,
            &quot;slug&quot;: &quot;lgbtq-themes&quot;
        },
        {
            &quot;id&quot;: 122,
            &quot;name&quot;: &quot;Lost Civilization&quot;,
            &quot;slug&quot;: &quot;lost-civilization&quot;
        },
        {
            &quot;id&quot;: 75,
            &quot;name&quot;: &quot;Love Triangle&quot;,
            &quot;slug&quot;: &quot;love-triangle&quot;
        },
        {
            &quot;id&quot;: 160,
            &quot;name&quot;: &quot;Mafia&quot;,
            &quot;slug&quot;: &quot;mafia&quot;
        },
        {
            &quot;id&quot;: 56,
            &quot;name&quot;: &quot;Magic&quot;,
            &quot;slug&quot;: &quot;magic&quot;
        },
        {
            &quot;id&quot;: 256,
            &quot;name&quot;: &quot;Mahjong&quot;,
            &quot;slug&quot;: &quot;mahjong&quot;
        },
        {
            &quot;id&quot;: 221,
            &quot;name&quot;: &quot;Mahou Shoujo&quot;,
            &quot;slug&quot;: &quot;mahou-shoujo&quot;
        },
        {
            &quot;id&quot;: 224,
            &quot;name&quot;: &quot;Maids&quot;,
            &quot;slug&quot;: &quot;maids&quot;
        },
        {
            &quot;id&quot;: 340,
            &quot;name&quot;: &quot;Makeup&quot;,
            &quot;slug&quot;: &quot;makeup&quot;
        },
        {
            &quot;id&quot;: 239,
            &quot;name&quot;: &quot;Male Harem&quot;,
            &quot;slug&quot;: &quot;male-harem&quot;
        },
        {
            &quot;id&quot;: 423,
            &quot;name&quot;: &quot;Male Pregnancy&quot;,
            &quot;slug&quot;: &quot;male-pregnancy&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;name&quot;: &quot;Male Protagonist&quot;,
            &quot;slug&quot;: &quot;male-protagonist&quot;
        },
        {
            &quot;id&quot;: 421,
            &quot;name&quot;: &quot;Manzai&quot;,
            &quot;slug&quot;: &quot;manzai&quot;
        },
        {
            &quot;id&quot;: 135,
            &quot;name&quot;: &quot;Marriage&quot;,
            &quot;slug&quot;: &quot;marriage&quot;
        },
        {
            &quot;id&quot;: 21,
            &quot;name&quot;: &quot;Martial Arts&quot;,
            &quot;slug&quot;: &quot;martial-arts&quot;
        },
        {
            &quot;id&quot;: 380,
            &quot;name&quot;: &quot;Masochism&quot;,
            &quot;slug&quot;: &quot;masochism&quot;
        },
        {
            &quot;id&quot;: 185,
            &quot;name&quot;: &quot;Masturbation&quot;,
            &quot;slug&quot;: &quot;masturbation&quot;
        },
        {
            &quot;id&quot;: 430,
            &quot;name&quot;: &quot;Matchmaking&quot;,
            &quot;slug&quot;: &quot;matchmaking&quot;
        },
        {
            &quot;id&quot;: 428,
            &quot;name&quot;: &quot;Mating Press&quot;,
            &quot;slug&quot;: &quot;mating-press&quot;
        },
        {
            &quot;id&quot;: 343,
            &quot;name&quot;: &quot;Matriarchy&quot;,
            &quot;slug&quot;: &quot;matriarchy&quot;
        },
        {
            &quot;id&quot;: 174,
            &quot;name&quot;: &quot;Mecha&quot;,
            &quot;slug&quot;: &quot;mecha&quot;
        },
        {
            &quot;id&quot;: 93,
            &quot;name&quot;: &quot;Medicine&quot;,
            &quot;slug&quot;: &quot;medicine&quot;
        },
        {
            &quot;id&quot;: 187,
            &quot;name&quot;: &quot;Medieval&quot;,
            &quot;slug&quot;: &quot;medieval&quot;
        },
        {
            &quot;id&quot;: 88,
            &quot;name&quot;: &quot;Memory Manipulation&quot;,
            &quot;slug&quot;: &quot;memory-manipulation&quot;
        },
        {
            &quot;id&quot;: 141,
            &quot;name&quot;: &quot;Mermaid&quot;,
            &quot;slug&quot;: &quot;mermaid&quot;
        },
        {
            &quot;id&quot;: 170,
            &quot;name&quot;: &quot;Meta&quot;,
            &quot;slug&quot;: &quot;meta&quot;
        },
        {
            &quot;id&quot;: 384,
            &quot;name&quot;: &quot;Metal Music&quot;,
            &quot;slug&quot;: &quot;metal-music&quot;
        },
        {
            &quot;id&quot;: 336,
            &quot;name&quot;: &quot;MILF&quot;,
            &quot;slug&quot;: &quot;milf&quot;
        },
        {
            &quot;id&quot;: 40,
            &quot;name&quot;: &quot;Military&quot;,
            &quot;slug&quot;: &quot;military&quot;
        },
        {
            &quot;id&quot;: 294,
            &quot;name&quot;: &quot;Mixed Gender Harem&quot;,
            &quot;slug&quot;: &quot;mixed-gender-harem&quot;
        },
        {
            &quot;id&quot;: 186,
            &quot;name&quot;: &quot;Mixed Media&quot;,
            &quot;slug&quot;: &quot;mixed-media&quot;
        },
        {
            &quot;id&quot;: 341,
            &quot;name&quot;: &quot;Modeling&quot;,
            &quot;slug&quot;: &quot;modeling&quot;
        },
        {
            &quot;id&quot;: 123,
            &quot;name&quot;: &quot;Monster Boy&quot;,
            &quot;slug&quot;: &quot;monster-boy&quot;
        },
        {
            &quot;id&quot;: 134,
            &quot;name&quot;: &quot;Monster Girl&quot;,
            &quot;slug&quot;: &quot;monster-girl&quot;
        },
        {
            &quot;id&quot;: 310,
            &quot;name&quot;: &quot;Mopeds&quot;,
            &quot;slug&quot;: &quot;mopeds&quot;
        },
        {
            &quot;id&quot;: 191,
            &quot;name&quot;: &quot;Motorcycles&quot;,
            &quot;slug&quot;: &quot;motorcycles&quot;
        },
        {
            &quot;id&quot;: 248,
            &quot;name&quot;: &quot;Mountaineering&quot;,
            &quot;slug&quot;: &quot;mountaineering&quot;
        },
        {
            &quot;id&quot;: 205,
            &quot;name&quot;: &quot;Music&quot;,
            &quot;slug&quot;: &quot;music&quot;
        },
        {
            &quot;id&quot;: 144,
            &quot;name&quot;: &quot;Musical Theater&quot;,
            &quot;slug&quot;: &quot;musical-theater&quot;
        },
        {
            &quot;id&quot;: 37,
            &quot;name&quot;: &quot;Mystery&quot;,
            &quot;slug&quot;: &quot;mystery&quot;
        },
        {
            &quot;id&quot;: 178,
            &quot;name&quot;: &quot;Mythology&quot;,
            &quot;slug&quot;: &quot;mythology&quot;
        },
        {
            &quot;id&quot;: 303,
            &quot;name&quot;: &quot;Nakadashi&quot;,
            &quot;slug&quot;: &quot;nakadashi&quot;
        },
        {
            &quot;id&quot;: 359,
            &quot;name&quot;: &quot;Natural Disaster&quot;,
            &quot;slug&quot;: &quot;natural-disaster&quot;
        },
        {
            &quot;id&quot;: 109,
            &quot;name&quot;: &quot;Necromancy&quot;,
            &quot;slug&quot;: &quot;necromancy&quot;
        },
        {
            &quot;id&quot;: 215,
            &quot;name&quot;: &quot;Nekomimi&quot;,
            &quot;slug&quot;: &quot;nekomimi&quot;
        },
        {
            &quot;id&quot;: 231,
            &quot;name&quot;: &quot;Netorare&quot;,
            &quot;slug&quot;: &quot;netorare&quot;
        },
        {
            &quot;id&quot;: 393,
            &quot;name&quot;: &quot;Netorase&quot;,
            &quot;slug&quot;: &quot;netorase&quot;
        },
        {
            &quot;id&quot;: 407,
            &quot;name&quot;: &quot;Netori&quot;,
            &quot;slug&quot;: &quot;netori&quot;
        },
        {
            &quot;id&quot;: 102,
            &quot;name&quot;: &quot;Ninja&quot;,
            &quot;slug&quot;: &quot;ninja&quot;
        },
        {
            &quot;id&quot;: 365,
            &quot;name&quot;: &quot;No Dialogue&quot;,
            &quot;slug&quot;: &quot;no-dialogue&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;name&quot;: &quot;Noir&quot;,
            &quot;slug&quot;: &quot;noir&quot;
        },
        {
            &quot;id&quot;: 418,
            &quot;name&quot;: &quot;Non-fiction&quot;,
            &quot;slug&quot;: &quot;non-fiction&quot;
        },
        {
            &quot;id&quot;: 31,
            &quot;name&quot;: &quot;Nudity&quot;,
            &quot;slug&quot;: &quot;nudity&quot;
        },
        {
            &quot;id&quot;: 167,
            &quot;name&quot;: &quot;Nun&quot;,
            &quot;slug&quot;: &quot;nun&quot;
        },
        {
            &quot;id&quot;: 369,
            &quot;name&quot;: &quot;Office&quot;,
            &quot;slug&quot;: &quot;office&quot;
        },
        {
            &quot;id&quot;: 326,
            &quot;name&quot;: &quot;Office Lady&quot;,
            &quot;slug&quot;: &quot;office-lady&quot;
        },
        {
            &quot;id&quot;: 273,
            &quot;name&quot;: &quot;Oiran&quot;,
            &quot;slug&quot;: &quot;oiran&quot;
        },
        {
            &quot;id&quot;: 216,
            &quot;name&quot;: &quot;Ojou-sama&quot;,
            &quot;slug&quot;: &quot;ojou-sama&quot;
        },
        {
            &quot;id&quot;: 431,
            &quot;name&quot;: &quot;Omegaverse&quot;,
            &quot;slug&quot;: &quot;omegaverse&quot;
        },
        {
            &quot;id&quot;: 94,
            &quot;name&quot;: &quot;Orphan&quot;,
            &quot;slug&quot;: &quot;orphan&quot;
        },
        {
            &quot;id&quot;: 285,
            &quot;name&quot;: &quot;Otaku Culture&quot;,
            &quot;slug&quot;: &quot;otaku-culture&quot;
        },
        {
            &quot;id&quot;: 275,
            &quot;name&quot;: &quot;Outdoor Activities&quot;,
            &quot;slug&quot;: &quot;outdoor-activities&quot;
        },
        {
            &quot;id&quot;: 374,
            &quot;name&quot;: &quot;Pandemic&quot;,
            &quot;slug&quot;: &quot;pandemic&quot;
        },
        {
            &quot;id&quot;: 244,
            &quot;name&quot;: &quot;Parenthood&quot;,
            &quot;slug&quot;: &quot;parenthood&quot;
        },
        {
            &quot;id&quot;: 378,
            &quot;name&quot;: &quot;Parkour&quot;,
            &quot;slug&quot;: &quot;parkour&quot;
        },
        {
            &quot;id&quot;: 153,
            &quot;name&quot;: &quot;Parody&quot;,
            &quot;slug&quot;: &quot;parody&quot;
        },
        {
            &quot;id&quot;: 419,
            &quot;name&quot;: &quot;Pet Play&quot;,
            &quot;slug&quot;: &quot;pet-play&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;name&quot;: &quot;Philosophy&quot;,
            &quot;slug&quot;: &quot;philosophy&quot;
        },
        {
            &quot;id&quot;: 265,
            &quot;name&quot;: &quot;Photography&quot;,
            &quot;slug&quot;: &quot;photography&quot;
        },
        {
            &quot;id&quot;: 116,
            &quot;name&quot;: &quot;Pirates&quot;,
            &quot;slug&quot;: &quot;pirates&quot;
        },
        {
            &quot;id&quot;: 370,
            &quot;name&quot;: &quot;Poker&quot;,
            &quot;slug&quot;: &quot;poker&quot;
        },
        {
            &quot;id&quot;: 30,
            &quot;name&quot;: &quot;Police&quot;,
            &quot;slug&quot;: &quot;police&quot;
        },
        {
            &quot;id&quot;: 91,
            &quot;name&quot;: &quot;Politics&quot;,
            &quot;slug&quot;: &quot;politics&quot;
        },
        {
            &quot;id&quot;: 383,
            &quot;name&quot;: &quot;Polyamorous&quot;,
            &quot;slug&quot;: &quot;polyamorous&quot;
        },
        {
            &quot;id&quot;: 43,
            &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
            &quot;slug&quot;: &quot;post-apocalyptic&quot;
        },
        {
            &quot;id&quot;: 159,
            &quot;name&quot;: &quot;POV&quot;,
            &quot;slug&quot;: &quot;pov&quot;
        },
        {
            &quot;id&quot;: 254,
            &quot;name&quot;: &quot;Pregnancy&quot;,
            &quot;slug&quot;: &quot;pregnancy&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
            &quot;slug&quot;: &quot;primarily-adult-cast&quot;
        },
        {
            &quot;id&quot;: 356,
            &quot;name&quot;: &quot;Primarily Animal Cast&quot;,
            &quot;slug&quot;: &quot;primarily-animal-cast&quot;
        },
        {
            &quot;id&quot;: 105,
            &quot;name&quot;: &quot;Primarily Child Cast&quot;,
            &quot;slug&quot;: &quot;primarily-child-cast&quot;
        },
        {
            &quot;id&quot;: 196,
            &quot;name&quot;: &quot;Primarily Female Cast&quot;,
            &quot;slug&quot;: &quot;primarily-female-cast&quot;
        },
        {
            &quot;id&quot;: 67,
            &quot;name&quot;: &quot;Primarily Male Cast&quot;,
            &quot;slug&quot;: &quot;primarily-male-cast&quot;
        },
        {
            &quot;id&quot;: 115,
            &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
            &quot;slug&quot;: &quot;primarily-teen-cast&quot;
        },
        {
            &quot;id&quot;: 124,
            &quot;name&quot;: &quot;Prison&quot;,
            &quot;slug&quot;: &quot;prison&quot;
        },
        {
            &quot;id&quot;: 288,
            &quot;name&quot;: &quot;Prostitution&quot;,
            &quot;slug&quot;: &quot;prostitution&quot;
        },
        {
            &quot;id&quot;: 202,
            &quot;name&quot;: &quot;Proxy Battle&quot;,
            &quot;slug&quot;: &quot;proxy-battle&quot;
        },
        {
            &quot;id&quot;: 85,
            &quot;name&quot;: &quot;Psychological&quot;,
            &quot;slug&quot;: &quot;psychological&quot;
        },
        {
            &quot;id&quot;: 176,
            &quot;name&quot;: &quot;Psychosexual&quot;,
            &quot;slug&quot;: &quot;psychosexual&quot;
        },
        {
            &quot;id&quot;: 349,
            &quot;name&quot;: &quot;Public Sex&quot;,
            &quot;slug&quot;: &quot;public-sex&quot;
        },
        {
            &quot;id&quot;: 416,
            &quot;name&quot;: &quot;Puppetry&quot;,
            &quot;slug&quot;: &quot;puppetry&quot;
        },
        {
            &quot;id&quot;: 392,
            &quot;name&quot;: &quot;Rakugo&quot;,
            &quot;slug&quot;: &quot;rakugo&quot;
        },
        {
            &quot;id&quot;: 83,
            &quot;name&quot;: &quot;Rape&quot;,
            &quot;slug&quot;: &quot;rape&quot;
        },
        {
            &quot;id&quot;: 183,
            &quot;name&quot;: &quot;Real Robot&quot;,
            &quot;slug&quot;: &quot;real-robot&quot;
        },
        {
            &quot;id&quot;: 190,
            &quot;name&quot;: &quot;Rehabilitation&quot;,
            &quot;slug&quot;: &quot;rehabilitation&quot;
        },
        {
            &quot;id&quot;: 200,
            &quot;name&quot;: &quot;Reincarnation&quot;,
            &quot;slug&quot;: &quot;reincarnation&quot;
        },
        {
            &quot;id&quot;: 52,
            &quot;name&quot;: &quot;Religion&quot;,
            &quot;slug&quot;: &quot;religion&quot;
        },
        {
            &quot;id&quot;: 101,
            &quot;name&quot;: &quot;Rescue&quot;,
            &quot;slug&quot;: &quot;rescue&quot;
        },
        {
            &quot;id&quot;: 297,
            &quot;name&quot;: &quot;Restaurant&quot;,
            &quot;slug&quot;: &quot;restaurant&quot;
        },
        {
            &quot;id&quot;: 89,
            &quot;name&quot;: &quot;Revenge&quot;,
            &quot;slug&quot;: &quot;revenge&quot;
        },
        {
            &quot;id&quot;: 361,
            &quot;name&quot;: &quot;Reverse Isekai&quot;,
            &quot;slug&quot;: &quot;reverse-isekai&quot;
        },
        {
            &quot;id&quot;: 338,
            &quot;name&quot;: &quot;Rimjob&quot;,
            &quot;slug&quot;: &quot;rimjob&quot;
        },
        {
            &quot;id&quot;: 127,
            &quot;name&quot;: &quot;Robots&quot;,
            &quot;slug&quot;: &quot;robots&quot;
        },
        {
            &quot;id&quot;: 206,
            &quot;name&quot;: &quot;Rock Music&quot;,
            &quot;slug&quot;: &quot;rock-music&quot;
        },
        {
            &quot;id&quot;: 72,
            &quot;name&quot;: &quot;Romance&quot;,
            &quot;slug&quot;: &quot;romance&quot;
        },
        {
            &quot;id&quot;: 351,
            &quot;name&quot;: &quot;Rotoscoping&quot;,
            &quot;slug&quot;: &quot;rotoscoping&quot;
        },
        {
            &quot;id&quot;: 247,
            &quot;name&quot;: &quot;Royal Affairs&quot;,
            &quot;slug&quot;: &quot;royal-affairs&quot;
        },
        {
            &quot;id&quot;: 400,
            &quot;name&quot;: &quot;Rugby&quot;,
            &quot;slug&quot;: &quot;rugby&quot;
        },
        {
            &quot;id&quot;: 51,
            &quot;name&quot;: &quot;Rural&quot;,
            &quot;slug&quot;: &quot;rural&quot;
        },
        {
            &quot;id&quot;: 347,
            &quot;name&quot;: &quot;Sadism&quot;,
            &quot;slug&quot;: &quot;sadism&quot;
        },
        {
            &quot;id&quot;: 128,
            &quot;name&quot;: &quot;Samurai&quot;,
            &quot;slug&quot;: &quot;samurai&quot;
        },
        {
            &quot;id&quot;: 319,
            &quot;name&quot;: &quot;Satire&quot;,
            &quot;slug&quot;: &quot;satire&quot;
        },
        {
            &quot;id&quot;: 394,
            &quot;name&quot;: &quot;Scat&quot;,
            &quot;slug&quot;: &quot;scat&quot;
        },
        {
            &quot;id&quot;: 66,
            &quot;name&quot;: &quot;School&quot;,
            &quot;slug&quot;: &quot;school&quot;
        },
        {
            &quot;id&quot;: 68,
            &quot;name&quot;: &quot;School Club&quot;,
            &quot;slug&quot;: &quot;school-club&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Sci-Fi&quot;,
            &quot;slug&quot;: &quot;sci-fi&quot;
        },
        {
            &quot;id&quot;: 382,
            &quot;name&quot;: &quot;Scissoring&quot;,
            &quot;slug&quot;: &quot;scissoring&quot;
        },
        {
            &quot;id&quot;: 401,
            &quot;name&quot;: &quot;Scuba Diving&quot;,
            &quot;slug&quot;: &quot;scuba-diving&quot;
        },
        {
            &quot;id&quot;: 82,
            &quot;name&quot;: &quot;Seinen&quot;,
            &quot;slug&quot;: &quot;seinen&quot;
        },
        {
            &quot;id&quot;: 306,
            &quot;name&quot;: &quot;Sex Toys&quot;,
            &quot;slug&quot;: &quot;sex-toys&quot;
        },
        {
            &quot;id&quot;: 106,
            &quot;name&quot;: &quot;Shapeshifting&quot;,
            &quot;slug&quot;: &quot;shapeshifting&quot;
        },
        {
            &quot;id&quot;: 425,
            &quot;name&quot;: &quot;Shimaidon&quot;,
            &quot;slug&quot;: &quot;shimaidon&quot;
        },
        {
            &quot;id&quot;: 117,
            &quot;name&quot;: &quot;Ships&quot;,
            &quot;slug&quot;: &quot;ships&quot;
        },
        {
            &quot;id&quot;: 290,
            &quot;name&quot;: &quot;Shogi&quot;,
            &quot;slug&quot;: &quot;shogi&quot;
        },
        {
            &quot;id&quot;: 169,
            &quot;name&quot;: &quot;Shoujo&quot;,
            &quot;slug&quot;: &quot;shoujo&quot;
        },
        {
            &quot;id&quot;: 46,
            &quot;name&quot;: &quot;Shounen&quot;,
            &quot;slug&quot;: &quot;shounen&quot;
        },
        {
            &quot;id&quot;: 237,
            &quot;name&quot;: &quot;Shrine Maiden&quot;,
            &quot;slug&quot;: &quot;shrine-maiden&quot;
        },
        {
            &quot;id&quot;: 390,
            &quot;name&quot;: &quot;Skateboarding&quot;,
            &quot;slug&quot;: &quot;skateboarding&quot;
        },
        {
            &quot;id&quot;: 130,
            &quot;name&quot;: &quot;Skeleton&quot;,
            &quot;slug&quot;: &quot;skeleton&quot;
        },
        {
            &quot;id&quot;: 49,
            &quot;name&quot;: &quot;Slapstick&quot;,
            &quot;slug&quot;: &quot;slapstick&quot;
        },
        {
            &quot;id&quot;: 119,
            &quot;name&quot;: &quot;Slavery&quot;,
            &quot;slug&quot;: &quot;slavery&quot;
        },
        {
            &quot;id&quot;: 73,
            &quot;name&quot;: &quot;Slice of Life&quot;,
            &quot;slug&quot;: &quot;slice-of-life&quot;
        },
        {
            &quot;id&quot;: 266,
            &quot;name&quot;: &quot;Snowscape&quot;,
            &quot;slug&quot;: &quot;snowscape&quot;
        },
        {
            &quot;id&quot;: 281,
            &quot;name&quot;: &quot;Software Development&quot;,
            &quot;slug&quot;: &quot;software-development&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Space&quot;,
            &quot;slug&quot;: &quot;space&quot;
        },
        {
            &quot;id&quot;: 226,
            &quot;name&quot;: &quot;Space Opera&quot;,
            &quot;slug&quot;: &quot;space-opera&quot;
        },
        {
            &quot;id&quot;: 62,
            &quot;name&quot;: &quot;Spearplay&quot;,
            &quot;slug&quot;: &quot;spearplay&quot;
        },
        {
            &quot;id&quot;: 64,
            &quot;name&quot;: &quot;Sports&quot;,
            &quot;slug&quot;: &quot;sports&quot;
        },
        {
            &quot;id&quot;: 389,
            &quot;name&quot;: &quot;Squirting&quot;,
            &quot;slug&quot;: &quot;squirting&quot;
        },
        {
            &quot;id&quot;: 45,
            &quot;name&quot;: &quot;Steampunk&quot;,
            &quot;slug&quot;: &quot;steampunk&quot;
        },
        {
            &quot;id&quot;: 406,
            &quot;name&quot;: &quot;Stop Motion&quot;,
            &quot;slug&quot;: &quot;stop-motion&quot;
        },
        {
            &quot;id&quot;: 287,
            &quot;name&quot;: &quot;Succubus&quot;,
            &quot;slug&quot;: &quot;succubus&quot;
        },
        {
            &quot;id&quot;: 97,
            &quot;name&quot;: &quot;Suicide&quot;,
            &quot;slug&quot;: &quot;suicide&quot;
        },
        {
            &quot;id&quot;: 414,
            &quot;name&quot;: &quot;Sumata&quot;,
            &quot;slug&quot;: &quot;sumata&quot;
        },
        {
            &quot;id&quot;: 413,
            &quot;name&quot;: &quot;Sumo&quot;,
            &quot;slug&quot;: &quot;sumo&quot;
        },
        {
            &quot;id&quot;: 103,
            &quot;name&quot;: &quot;Super Power&quot;,
            &quot;slug&quot;: &quot;super-power&quot;
        },
        {
            &quot;id&quot;: 175,
            &quot;name&quot;: &quot;Super Robot&quot;,
            &quot;slug&quot;: &quot;super-robot&quot;
        },
        {
            &quot;id&quot;: 268,
            &quot;name&quot;: &quot;Superhero&quot;,
            &quot;slug&quot;: &quot;superhero&quot;
        },
        {
            &quot;id&quot;: 54,
            &quot;name&quot;: &quot;Supernatural&quot;,
            &quot;slug&quot;: &quot;supernatural&quot;
        },
        {
            &quot;id&quot;: 317,
            &quot;name&quot;: &quot;Surfing&quot;,
            &quot;slug&quot;: &quot;surfing&quot;
        },
        {
            &quot;id&quot;: 171,
            &quot;name&quot;: &quot;Surreal Comedy&quot;,
            &quot;slug&quot;: &quot;surreal-comedy&quot;
        },
        {
            &quot;id&quot;: 157,
            &quot;name&quot;: &quot;Survival&quot;,
            &quot;slug&quot;: &quot;survival&quot;
        },
        {
            &quot;id&quot;: 398,
            &quot;name&quot;: &quot;Sweat&quot;,
            &quot;slug&quot;: &quot;sweat&quot;
        },
        {
            &quot;id&quot;: 211,
            &quot;name&quot;: &quot;Swimming&quot;,
            &quot;slug&quot;: &quot;swimming&quot;
        },
        {
            &quot;id&quot;: 63,
            &quot;name&quot;: &quot;Swordplay&quot;,
            &quot;slug&quot;: &quot;swordplay&quot;
        },
        {
            &quot;id&quot;: 379,
            &quot;name&quot;: &quot;Table Tennis&quot;,
            &quot;slug&quot;: &quot;table-tennis&quot;
        },
        {
            &quot;id&quot;: 227,
            &quot;name&quot;: &quot;Tanks&quot;,
            &quot;slug&quot;: &quot;tanks&quot;
        },
        {
            &quot;id&quot;: 32,
            &quot;name&quot;: &quot;Tanned Skin&quot;,
            &quot;slug&quot;: &quot;tanned-skin&quot;
        },
        {
            &quot;id&quot;: 212,
            &quot;name&quot;: &quot;Teacher&quot;,
            &quot;slug&quot;: &quot;teacher&quot;
        },
        {
            &quot;id&quot;: 357,
            &quot;name&quot;: &quot;Teens&#039; Love&quot;,
            &quot;slug&quot;: &quot;teens-love&quot;
        },
        {
            &quot;id&quot;: 150,
            &quot;name&quot;: &quot;Tennis&quot;,
            &quot;slug&quot;: &quot;tennis&quot;
        },
        {
            &quot;id&quot;: 286,
            &quot;name&quot;: &quot;Tentacles&quot;,
            &quot;slug&quot;: &quot;tentacles&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;name&quot;: &quot;Terrorism&quot;,
            &quot;slug&quot;: &quot;terrorism&quot;
        },
        {
            &quot;id&quot;: 335,
            &quot;name&quot;: &quot;Threesome&quot;,
            &quot;slug&quot;: &quot;threesome&quot;
        },
        {
            &quot;id&quot;: 86,
            &quot;name&quot;: &quot;Thriller&quot;,
            &quot;slug&quot;: &quot;thriller&quot;
        },
        {
            &quot;id&quot;: 353,
            &quot;name&quot;: &quot;Time Loop&quot;,
            &quot;slug&quot;: &quot;time-loop&quot;
        },
        {
            &quot;id&quot;: 142,
            &quot;name&quot;: &quot;Time Manipulation&quot;,
            &quot;slug&quot;: &quot;time-manipulation&quot;
        },
        {
            &quot;id&quot;: 96,
            &quot;name&quot;: &quot;Time Skip&quot;,
            &quot;slug&quot;: &quot;time-skip&quot;
        },
        {
            &quot;id&quot;: 179,
            &quot;name&quot;: &quot;Tokusatsu&quot;,
            &quot;slug&quot;: &quot;tokusatsu&quot;
        },
        {
            &quot;id&quot;: 24,
            &quot;name&quot;: &quot;Tomboy&quot;,
            &quot;slug&quot;: &quot;tomboy&quot;
        },
        {
            &quot;id&quot;: 98,
            &quot;name&quot;: &quot;Torture&quot;,
            &quot;slug&quot;: &quot;torture&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;name&quot;: &quot;Tragedy&quot;,
            &quot;slug&quot;: &quot;tragedy&quot;
        },
        {
            &quot;id&quot;: 148,
            &quot;name&quot;: &quot;Trains&quot;,
            &quot;slug&quot;: &quot;trains&quot;
        },
        {
            &quot;id&quot;: 201,
            &quot;name&quot;: &quot;Transgender&quot;,
            &quot;slug&quot;: &quot;transgender&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;name&quot;: &quot;Travel&quot;,
            &quot;slug&quot;: &quot;travel&quot;
        },
        {
            &quot;id&quot;: 246,
            &quot;name&quot;: &quot;Triads&quot;,
            &quot;slug&quot;: &quot;triads&quot;
        },
        {
            &quot;id&quot;: 154,
            &quot;name&quot;: &quot;Tsundere&quot;,
            &quot;slug&quot;: &quot;tsundere&quot;
        },
        {
            &quot;id&quot;: 47,
            &quot;name&quot;: &quot;Twins&quot;,
            &quot;slug&quot;: &quot;twins&quot;
        },
        {
            &quot;id&quot;: 77,
            &quot;name&quot;: &quot;Unrequited Love&quot;,
            &quot;slug&quot;: &quot;unrequited-love&quot;
        },
        {
            &quot;id&quot;: 38,
            &quot;name&quot;: &quot;Urban&quot;,
            &quot;slug&quot;: &quot;urban&quot;
        },
        {
            &quot;id&quot;: 57,
            &quot;name&quot;: &quot;Urban Fantasy&quot;,
            &quot;slug&quot;: &quot;urban-fantasy&quot;
        },
        {
            &quot;id&quot;: 166,
            &quot;name&quot;: &quot;Vampire&quot;,
            &quot;slug&quot;: &quot;vampire&quot;
        },
        {
            &quot;id&quot;: 429,
            &quot;name&quot;: &quot;Vertical Video&quot;,
            &quot;slug&quot;: &quot;vertical-video&quot;
        },
        {
            &quot;id&quot;: 312,
            &quot;name&quot;: &quot;Veterinarian&quot;,
            &quot;slug&quot;: &quot;veterinarian&quot;
        },
        {
            &quot;id&quot;: 193,
            &quot;name&quot;: &quot;Video Games&quot;,
            &quot;slug&quot;: &quot;video-games&quot;
        },
        {
            &quot;id&quot;: 415,
            &quot;name&quot;: &quot;Vikings&quot;,
            &quot;slug&quot;: &quot;vikings&quot;
        },
        {
            &quot;id&quot;: 367,
            &quot;name&quot;: &quot;Villainess&quot;,
            &quot;slug&quot;: &quot;villainess&quot;
        },
        {
            &quot;id&quot;: 350,
            &quot;name&quot;: &quot;Virginity&quot;,
            &quot;slug&quot;: &quot;virginity&quot;
        },
        {
            &quot;id&quot;: 192,
            &quot;name&quot;: &quot;Virtual World&quot;,
            &quot;slug&quot;: &quot;virtual-world&quot;
        },
        {
            &quot;id&quot;: 417,
            &quot;name&quot;: &quot;Vocal Synth&quot;,
            &quot;slug&quot;: &quot;vocal-synth&quot;
        },
        {
            &quot;id&quot;: 263,
            &quot;name&quot;: &quot;Volleyball&quot;,
            &quot;slug&quot;: &quot;volleyball&quot;
        },
        {
            &quot;id&quot;: 311,
            &quot;name&quot;: &quot;Vore&quot;,
            &quot;slug&quot;: &quot;vore&quot;
        },
        {
            &quot;id&quot;: 305,
            &quot;name&quot;: &quot;Voyeur&quot;,
            &quot;slug&quot;: &quot;voyeur&quot;
        },
        {
            &quot;id&quot;: 427,
            &quot;name&quot;: &quot;VTuber&quot;,
            &quot;slug&quot;: &quot;vtuber&quot;
        },
        {
            &quot;id&quot;: 118,
            &quot;name&quot;: &quot;War&quot;,
            &quot;slug&quot;: &quot;war&quot;
        },
        {
            &quot;id&quot;: 391,
            &quot;name&quot;: &quot;Watersports&quot;,
            &quot;slug&quot;: &quot;watersports&quot;
        },
        {
            &quot;id&quot;: 245,
            &quot;name&quot;: &quot;Werewolf&quot;,
            &quot;slug&quot;: &quot;werewolf&quot;
        },
        {
            &quot;id&quot;: 242,
            &quot;name&quot;: &quot;Wilderness&quot;,
            &quot;slug&quot;: &quot;wilderness&quot;
        },
        {
            &quot;id&quot;: 58,
            &quot;name&quot;: &quot;Witch&quot;,
            &quot;slug&quot;: &quot;witch&quot;
        },
        {
            &quot;id&quot;: 36,
            &quot;name&quot;: &quot;Work&quot;,
            &quot;slug&quot;: &quot;work&quot;
        },
        {
            &quot;id&quot;: 236,
            &quot;name&quot;: &quot;Wrestling&quot;,
            &quot;slug&quot;: &quot;wrestling&quot;
        },
        {
            &quot;id&quot;: 293,
            &quot;name&quot;: &quot;Writing&quot;,
            &quot;slug&quot;: &quot;writing&quot;
        },
        {
            &quot;id&quot;: 235,
            &quot;name&quot;: &quot;Wuxia&quot;,
            &quot;slug&quot;: &quot;wuxia&quot;
        },
        {
            &quot;id&quot;: 28,
            &quot;name&quot;: &quot;Yakuza&quot;,
            &quot;slug&quot;: &quot;yakuza&quot;
        },
        {
            &quot;id&quot;: 225,
            &quot;name&quot;: &quot;Yandere&quot;,
            &quot;slug&quot;: &quot;yandere&quot;
        },
        {
            &quot;id&quot;: 252,
            &quot;name&quot;: &quot;Youkai&quot;,
            &quot;slug&quot;: &quot;youkai&quot;
        },
        {
            &quot;id&quot;: 195,
            &quot;name&quot;: &quot;Yuri&quot;,
            &quot;slug&quot;: &quot;yuri&quot;
        },
        {
            &quot;id&quot;: 145,
            &quot;name&quot;: &quot;Zombie&quot;,
            &quot;slug&quot;: &quot;zombie&quot;
        },
        {
            &quot;id&quot;: 403,
            &quot;name&quot;: &quot;Zoophilia&quot;,
            &quot;slug&quot;: &quot;zoophilia&quot;
        }
    ],
    &quot;total&quot;: 431
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-tags" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-tags"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-tags"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-tags" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-tags">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-tags" data-method="GET"
      data-path="api/v1/public/tags"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-tags', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-tags"
                    onclick="tryItOut('GETapi-v1-public-tags');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-tags"
                    onclick="cancelTryOut('GETapi-v1-public-tags');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-tags"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/tags</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-tags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-tags"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-public-anime--anime_id-">GET api/v1/public/anime/{anime_id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime--anime_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-anime--anime_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 385,
        &quot;title&quot;: &quot;Final Fantasy VII: Last Order&quot;,
        &quot;slug&quot;: &quot;final-fantasy-vii-last-order-408&quot;,
        &quot;description&quot;: &quot;After the destruction of Nibelheim at the hands of Sephiroth, Zack and Cloud are on the run from Shinra Inc. As they make their way back to Midgar, they recall the horrible events that happened at Nibelheim, as well as fight for survival against Shinra.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
        &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx408-iQDfox4DSCGb.png&quot;,
        &quot;rating&quot;: &quot;6.70&quot;,
        &quot;year&quot;: 2005,
        &quot;status&quot;: &quot;finished&quot;,
        &quot;type&quot;: &quot;ova&quot;,
        &quot;number_of_episodes&quot;: 1,
        &quot;aired_from&quot;: null,
        &quot;aired_to&quot;: null,
        &quot;nsfw_flag&quot;: false,
        &quot;popularity&quot;: 9157,
        &quot;favorites&quot;: 52,
        &quot;external_id&quot;: &quot;408&quot;,
        &quot;external_source&quot;: &quot;anilist&quot;,
        &quot;tags&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Action&quot;,
                &quot;slug&quot;: &quot;action&quot;
            },
            {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Adventure&quot;,
                &quot;slug&quot;: &quot;adventure&quot;
            },
            {
                &quot;id&quot;: 3,
                &quot;name&quot;: &quot;Drama&quot;,
                &quot;slug&quot;: &quot;drama&quot;
            },
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Sci-Fi&quot;,
                &quot;slug&quot;: &quot;sci-fi&quot;
            },
            {
                &quot;id&quot;: 15,
                &quot;name&quot;: &quot;Guns&quot;,
                &quot;slug&quot;: &quot;guns&quot;
            },
            {
                &quot;id&quot;: 16,
                &quot;name&quot;: &quot;Male Protagonist&quot;,
                &quot;slug&quot;: &quot;male-protagonist&quot;
            },
            {
                &quot;id&quot;: 17,
                &quot;name&quot;: &quot;Cyberpunk&quot;,
                &quot;slug&quot;: &quot;cyberpunk&quot;
            },
            {
                &quot;id&quot;: 40,
                &quot;name&quot;: &quot;Military&quot;,
                &quot;slug&quot;: &quot;military&quot;
            },
            {
                &quot;id&quot;: 42,
                &quot;name&quot;: &quot;Fugitive&quot;,
                &quot;slug&quot;: &quot;fugitive&quot;
            },
            {
                &quot;id&quot;: 48,
                &quot;name&quot;: &quot;Aliens&quot;,
                &quot;slug&quot;: &quot;aliens&quot;
            },
            {
                &quot;id&quot;: 61,
                &quot;name&quot;: &quot;Fantasy&quot;,
                &quot;slug&quot;: &quot;fantasy&quot;
            },
            {
                &quot;id&quot;: 63,
                &quot;name&quot;: &quot;Swordplay&quot;,
                &quot;slug&quot;: &quot;swordplay&quot;
            },
            {
                &quot;id&quot;: 67,
                &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                &quot;slug&quot;: &quot;primarily-male-cast&quot;
            },
            {
                &quot;id&quot;: 191,
                &quot;name&quot;: &quot;Motorcycles&quot;,
                &quot;slug&quot;: &quot;motorcycles&quot;
            }
        ],
        &quot;created_at&quot;: &quot;2026-01-01T09:34:14.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-01T09:34:14.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-anime--anime_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-anime--anime_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-anime--anime_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-anime--anime_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-anime--anime_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-anime--anime_id-" data-method="GET"
      data-path="api/v1/public/anime/{anime_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-anime--anime_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-anime--anime_id-"
                    onclick="tryItOut('GETapi-v1-public-anime--anime_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-anime--anime_id-"
                    onclick="cancelTryOut('GETapi-v1-public-anime--anime_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-anime--anime_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/anime/{anime_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-anime--anime_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-anime--anime_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime_id"                data-endpoint="GETapi-v1-public-anime--anime_id-"
               value="385"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-anime--anime_id--comments">GET api/v1/public/anime/{anime_id}/comments</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime--anime_id--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-anime--anime_id--comments">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/comments?page=1&quot;,
        &quot;last&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/comments?page=1&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: null
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: null,
        &quot;last_page&quot;: 1,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/comments?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/comments&quot;,
        &quot;per_page&quot;: 50,
        &quot;to&quot;: null,
        &quot;total&quot;: 0
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-anime--anime_id--comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-anime--anime_id--comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-anime--anime_id--comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-anime--anime_id--comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-anime--anime_id--comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-anime--anime_id--comments" data-method="GET"
      data-path="api/v1/public/anime/{anime_id}/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-anime--anime_id--comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-anime--anime_id--comments"
                    onclick="tryItOut('GETapi-v1-public-anime--anime_id--comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-anime--anime_id--comments"
                    onclick="cancelTryOut('GETapi-v1-public-anime--anime_id--comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-anime--anime_id--comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/anime/{anime_id}/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-anime--anime_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-anime--anime_id--comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime_id"                data-endpoint="GETapi-v1-public-anime--anime_id--comments"
               value="385"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-anime--anime_id--episodes">GET api/v1/public/anime/{anime_id}/episodes</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime--anime_id--episodes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/episodes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/episodes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-anime--anime_id--episodes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-anime--anime_id--episodes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-anime--anime_id--episodes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-anime--anime_id--episodes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-anime--anime_id--episodes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-anime--anime_id--episodes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-anime--anime_id--episodes" data-method="GET"
      data-path="api/v1/public/anime/{anime_id}/episodes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-anime--anime_id--episodes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-anime--anime_id--episodes"
                    onclick="tryItOut('GETapi-v1-public-anime--anime_id--episodes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-anime--anime_id--episodes"
                    onclick="cancelTryOut('GETapi-v1-public-anime--anime_id--episodes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-anime--anime_id--episodes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/anime/{anime_id}/episodes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-anime--anime_id--episodes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-anime--anime_id--episodes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime_id"                data-endpoint="GETapi-v1-public-anime--anime_id--episodes"
               value="385"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-anime--anime_id--community-stats">GET api/v1/public/anime/{anime_id}/community-stats</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime--anime_id--community-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/community-stats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/anime/385/community-stats"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-anime--anime_id--community-stats">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;watching&quot;: 0,
    &quot;planned&quot;: 0,
    &quot;completed&quot;: 0,
    &quot;on_hold&quot;: 0,
    &quot;dropped&quot;: 0,
    &quot;total&quot;: 0
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-anime--anime_id--community-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-anime--anime_id--community-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-anime--anime_id--community-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-anime--anime_id--community-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-anime--anime_id--community-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-anime--anime_id--community-stats" data-method="GET"
      data-path="api/v1/public/anime/{anime_id}/community-stats"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-anime--anime_id--community-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-anime--anime_id--community-stats"
                    onclick="tryItOut('GETapi-v1-public-anime--anime_id--community-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-anime--anime_id--community-stats"
                    onclick="cancelTryOut('GETapi-v1-public-anime--anime_id--community-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-anime--anime_id--community-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/anime/{anime_id}/community-stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-anime--anime_id--community-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-anime--anime_id--community-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime_id"                data-endpoint="GETapi-v1-public-anime--anime_id--community-stats"
               value="385"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-episodes--episode-">GET api/v1/public/episodes/{episode}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-episodes--episode-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-episodes--episode-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;anime_id&quot;: 2,
    &quot;episode_number&quot;: 1,
    &quot;season_number&quot;: 1,
    &quot;title&quot;: null,
    &quot;player_url&quot;: &quot;//kodik.info/seria/757652/fb2ff431ebe0d42a9829b5ea07f2183d/720p&quot;,
    &quot;player_iframe&quot;: null,
    &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
    &quot;translation_type&quot;: &quot;voice&quot;,
    &quot;quality&quot;: &quot;BDRip 720p&quot;,
    &quot;source&quot;: &quot;kodik&quot;,
    &quot;external_id&quot;: null,
    &quot;external_episode_id&quot;: null,
    &quot;aired_at&quot;: null,
    &quot;release_date&quot;: null,
    &quot;duration&quot;: null,
    &quot;thumbnail_url&quot;: null,
    &quot;poster_url&quot;: null,
    &quot;priority&quot;: 50,
    &quot;created_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2026-01-01T10:23:11.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-episodes--episode-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-episodes--episode-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-episodes--episode-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-episodes--episode-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-episodes--episode-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-episodes--episode-" data-method="GET"
      data-path="api/v1/public/episodes/{episode}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-episodes--episode-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-episodes--episode-"
                    onclick="tryItOut('GETapi-v1-public-episodes--episode-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-episodes--episode-"
                    onclick="cancelTryOut('GETapi-v1-public-episodes--episode-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-episodes--episode-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/episodes/{episode}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-episodes--episode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-episodes--episode-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>episode</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="episode"                data-endpoint="GETapi-v1-public-episodes--episode-"
               value="1"
               data-component="url">
    <br>
<p>The episode. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-episodes--episode--player">GET api/v1/public/episodes/{episode}/player</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-episodes--episode--player">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes/1/player" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/episodes/1/player"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-episodes--episode--player">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;player_url&quot;: &quot;//kodik.info/seria/757652/fb2ff431ebe0d42a9829b5ea07f2183d/720p&quot;,
    &quot;player_iframe&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-episodes--episode--player" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-episodes--episode--player"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-episodes--episode--player"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-episodes--episode--player" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-episodes--episode--player">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-episodes--episode--player" data-method="GET"
      data-path="api/v1/public/episodes/{episode}/player"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-episodes--episode--player', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-episodes--episode--player"
                    onclick="tryItOut('GETapi-v1-public-episodes--episode--player');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-episodes--episode--player"
                    onclick="cancelTryOut('GETapi-v1-public-episodes--episode--player');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-episodes--episode--player"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/episodes/{episode}/player</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-episodes--episode--player"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-episodes--episode--player"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>episode</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="episode"                data-endpoint="GETapi-v1-public-episodes--episode--player"
               value="1"
               data-component="url">
    <br>
<p>The episode. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-users--userId--statistics">GET api/v1/public/users/{userId}/statistics</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-users--userId--statistics">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/users/2/statistics" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/public/users/2/statistics"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-public-users--userId--statistics">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status_counts&quot;: {
        &quot;watching&quot;: 0,
        &quot;planned&quot;: 0,
        &quot;completed&quot;: 0,
        &quot;on_hold&quot;: 0,
        &quot;dropped&quot;: 0
    },
    &quot;episodes_watched&quot;: 0,
    &quot;total_watch_time&quot;: 0,
    &quot;recent_ratings&quot;: [],
    &quot;watch_dynamics&quot;: [
        {
            &quot;date&quot;: &quot;2025-12-24&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2025-12-25&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2025-12-26&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2025-12-27&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2025-12-28&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2025-12-29&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2025-12-30&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2025-12-31&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2026-01-01&quot;,
            &quot;count&quot;: 0
        },
        {
            &quot;date&quot;: &quot;2026-01-02&quot;,
            &quot;count&quot;: 0
        }
    ],
    &quot;recently_watched&quot;: [],
    &quot;comments_count&quot;: 0
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-public-users--userId--statistics" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-public-users--userId--statistics"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-public-users--userId--statistics"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-public-users--userId--statistics" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-public-users--userId--statistics">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-public-users--userId--statistics" data-method="GET"
      data-path="api/v1/public/users/{userId}/statistics"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-public-users--userId--statistics', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-public-users--userId--statistics"
                    onclick="tryItOut('GETapi-v1-public-users--userId--statistics');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-public-users--userId--statistics"
                    onclick="cancelTryOut('GETapi-v1-public-users--userId--statistics');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-public-users--userId--statistics"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/public/users/{userId}/statistics</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-public-users--userId--statistics"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-public-users--userId--statistics"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>userId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="userId"                data-endpoint="GETapi-v1-public-users--userId--statistics"
               value="2"
               data-component="url">
    <br>
<p>Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-v1-auth-register">POST api/v1/auth/register</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"email\": \"zbailey@example.net\",
    \"password\": \"-0pBNvYgxw\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "email": "zbailey@example.net",
    "password": "-0pBNvYgxw"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-register">
</span>
<span id="execution-results-POSTapi-v1-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-register" data-method="POST"
      data-path="api/v1/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-register"
                    onclick="tryItOut('POSTapi-v1-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-register"
                    onclick="cancelTryOut('POSTapi-v1-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-v1-auth-register"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-register"
               value="zbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>zbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-register"
               value="-0pBNvYgxw"
               data-component="body">
    <br>
<p>Must be at least 8 characters. Example: <code>-0pBNvYgxw</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-auth-login">POST api/v1/auth/login</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"|]|{+-\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "gbailey@example.net",
    "password": "|]|{+-"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-login">
</span>
<span id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-login" data-method="POST"
      data-path="api/v1/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-login"
                    onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-login"
                    onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-v1-auth-login"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Must be a valid email address. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-v1-auth-login"
               value="|]|{+-"
               data-component="body">
    <br>
<p>Example: <code>|]|{+-</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-user">GET api/v1/user</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-user" data-method="GET"
      data-path="api/v1/user"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-user"
                    onclick="tryItOut('GETapi-v1-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-user"
                    onclick="cancelTryOut('GETapi-v1-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-auth-logout">POST api/v1/auth/logout</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/auth/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/auth/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-auth-logout">
</span>
<span id="execution-results-POSTapi-v1-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-auth-logout" data-method="POST"
      data-path="api/v1/auth/logout"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-auth-logout"
                    onclick="tryItOut('POSTapi-v1-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-auth-logout"
                    onclick="cancelTryOut('POSTapi-v1-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-my-comments">GET api/v1/my-comments</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-my-comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/my-comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/my-comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-my-comments">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-my-comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-my-comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-my-comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-my-comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-my-comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-my-comments" data-method="GET"
      data-path="api/v1/my-comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-my-comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-my-comments"
                    onclick="tryItOut('GETapi-v1-my-comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-my-comments"
                    onclick="cancelTryOut('GETapi-v1-my-comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-my-comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/my-comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-my-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-my-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-comments">POST api/v1/comments</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"anime_id\": 16,
    \"comment\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/comments"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "anime_id": 16,
    "comment": "n"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-comments">
</span>
<span id="execution-results-POSTapi-v1-comments" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-comments"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-comments"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-comments" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-comments">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-comments" data-method="POST"
      data-path="api/v1/comments"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-comments', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-comments"
                    onclick="tryItOut('POSTapi-v1-comments');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-comments"
                    onclick="cancelTryOut('POSTapi-v1-comments');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-comments"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/comments</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-comments"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>anime_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime_id"                data-endpoint="POSTapi-v1-comments"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the anime table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment"                data-endpoint="POSTapi-v1-comments"
               value="n"
               data-component="body">
    <br>
<p>Must be at least 3 characters. Must not be greater than 1000 characters. Example: <code>n</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-v1-comments--id-">PUT api/v1/comments/{id}</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/comments/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"comment\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/comments/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "comment": "b"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-comments--id-">
</span>
<span id="execution-results-PUTapi-v1-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-comments--id-" data-method="PUT"
      data-path="api/v1/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-comments--id-"
                    onclick="tryItOut('PUTapi-v1-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-comments--id-"
                    onclick="cancelTryOut('PUTapi-v1-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/comments/{id}</code></b>
        </p>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-v1-comments--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>16</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>comment</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="comment"                data-endpoint="PUTapi-v1-comments--id-"
               value="b"
               data-component="body">
    <br>
<p>Must be at least 3 characters. Must not be greater than 1000 characters. Example: <code>b</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-comments--id-">DELETE api/v1/comments/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-comments--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/comments/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/comments/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-comments--id-">
</span>
<span id="execution-results-DELETEapi-v1-comments--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-comments--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-comments--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-comments--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-comments--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-comments--id-" data-method="DELETE"
      data-path="api/v1/comments/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-comments--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-comments--id-"
                    onclick="tryItOut('DELETEapi-v1-comments--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-comments--id-"
                    onclick="cancelTryOut('DELETEapi-v1-comments--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-comments--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/comments/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-comments--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-v1-comments--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>16</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-profile-me">GET api/v1/profile/me</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-profile-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/profile/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/profile/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-profile-me">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-profile-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-profile-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-profile-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-profile-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-profile-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-profile-me" data-method="GET"
      data-path="api/v1/profile/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-profile-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-profile-me"
                    onclick="tryItOut('GETapi-v1-profile-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-profile-me"
                    onclick="cancelTryOut('GETapi-v1-profile-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-profile-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/profile/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-profile-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-profile-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTapi-v1-profile-me">PUT api/v1/profile/me</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-profile-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/profile/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"bio\": \"n\",
    \"custom_status\": \"g\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/profile/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "bio": "n",
    "custom_status": "g"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-profile-me">
</span>
<span id="execution-results-PUTapi-v1-profile-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-profile-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-profile-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-profile-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-profile-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-profile-me" data-method="PUT"
      data-path="api/v1/profile/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-profile-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-profile-me"
                    onclick="tryItOut('PUTapi-v1-profile-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-profile-me"
                    onclick="cancelTryOut('PUTapi-v1-profile-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-profile-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/profile/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-profile-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-profile-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-v1-profile-me"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>bio</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="bio"                data-endpoint="PUTapi-v1-profile-me"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 500 characters. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>custom_status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="custom_status"                data-endpoint="PUTapi-v1-profile-me"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>g</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-v1-profile-me-avatar">POST api/v1/profile/me/avatar</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-profile-me-avatar">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/profile/me/avatar" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "avatar=@C:\Users\Тамерлан\AppData\Local\Temp\php30F7.tmp" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/profile/me/avatar"
);

const headers = {
    "Content-Type": "multipart/form-data",
    "Accept": "application/json",
};

const body = new FormData();
body.append('avatar', document.querySelector('input[name="avatar"]').files[0]);

fetch(url, {
    method: "POST",
    headers,
    body,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-profile-me-avatar">
</span>
<span id="execution-results-POSTapi-v1-profile-me-avatar" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-profile-me-avatar"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-profile-me-avatar"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-profile-me-avatar" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-profile-me-avatar">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-profile-me-avatar" data-method="POST"
      data-path="api/v1/profile/me/avatar"
      data-authed="0"
      data-hasfiles="1"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-profile-me-avatar', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-profile-me-avatar"
                    onclick="tryItOut('POSTapi-v1-profile-me-avatar');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-profile-me-avatar"
                    onclick="cancelTryOut('POSTapi-v1-profile-me-avatar');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-profile-me-avatar"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/profile/me/avatar</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-profile-me-avatar"
               value="multipart/form-data"
               data-component="header">
    <br>
<p>Example: <code>multipart/form-data</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-profile-me-avatar"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar</code></b>&nbsp;&nbsp;
<small>file</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="file" style="display: none"
                              name="avatar"                data-endpoint="POSTapi-v1-profile-me-avatar"
               value=""
               data-component="body">
    <br>
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>C:\Users\Тамерлан\AppData\Local\Temp\php30F7.tmp</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-statistics-me">GET api/v1/statistics/me</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-statistics-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/statistics/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/statistics/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-statistics-me">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-statistics-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-statistics-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-statistics-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-statistics-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-statistics-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-statistics-me" data-method="GET"
      data-path="api/v1/statistics/me"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-statistics-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-statistics-me"
                    onclick="tryItOut('GETapi-v1-statistics-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-statistics-me"
                    onclick="cancelTryOut('GETapi-v1-statistics-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-statistics-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/statistics/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-statistics-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-statistics-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-v1-statistics-me-episodes-summary">GET api/v1/statistics/me/episodes-summary</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-statistics-me-episodes-summary">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/statistics/me/episodes-summary" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/statistics/me/episodes-summary"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-statistics-me-episodes-summary">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-statistics-me-episodes-summary" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-statistics-me-episodes-summary"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-statistics-me-episodes-summary"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-statistics-me-episodes-summary" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-statistics-me-episodes-summary">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-statistics-me-episodes-summary" data-method="GET"
      data-path="api/v1/statistics/me/episodes-summary"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-statistics-me-episodes-summary', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-statistics-me-episodes-summary"
                    onclick="tryItOut('GETapi-v1-statistics-me-episodes-summary');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-statistics-me-episodes-summary"
                    onclick="cancelTryOut('GETapi-v1-statistics-me-episodes-summary');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-statistics-me-episodes-summary"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/statistics/me/episodes-summary</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-statistics-me-episodes-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-statistics-me-episodes-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-anime--anime--status">POST api/v1/anime/{anime}/status</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-anime--anime--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime/385/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"dropped\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime/385/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "dropped"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-anime--anime--status">
</span>
<span id="execution-results-POSTapi-v1-anime--anime--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-anime--anime--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-anime--anime--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-anime--anime--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-anime--anime--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-anime--anime--status" data-method="POST"
      data-path="api/v1/anime/{anime}/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-anime--anime--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-anime--anime--status"
                    onclick="tryItOut('POSTapi-v1-anime--anime--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-anime--anime--status"
                    onclick="cancelTryOut('POSTapi-v1-anime--anime--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-anime--anime--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/anime/{anime}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-anime--anime--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-anime--anime--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime"                data-endpoint="POSTapi-v1-anime--anime--status"
               value="385"
               data-component="url">
    <br>
<p>The anime. Example: <code>385</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-v1-anime--anime--status"
               value="dropped"
               data-component="body">
    <br>
<p>Example: <code>dropped</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>watching</code></li> <li><code>planned</code></li> <li><code>completed</code></li> <li><code>on_hold</code></li> <li><code>dropped</code></li> <li><code>not_watching</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-anime--anime--user-status">GET api/v1/anime/{anime}/user-status</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-anime--anime--user-status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime/385/user-status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime/385/user-status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-anime--anime--user-status">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-anime--anime--user-status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-anime--anime--user-status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-anime--anime--user-status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-anime--anime--user-status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-anime--anime--user-status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-anime--anime--user-status" data-method="GET"
      data-path="api/v1/anime/{anime}/user-status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-anime--anime--user-status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-anime--anime--user-status"
                    onclick="tryItOut('GETapi-v1-anime--anime--user-status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-anime--anime--user-status"
                    onclick="cancelTryOut('GETapi-v1-anime--anime--user-status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-anime--anime--user-status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/anime/{anime}/user-status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-anime--anime--user-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-anime--anime--user-status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime"                data-endpoint="GETapi-v1-anime--anime--user-status"
               value="385"
               data-component="url">
    <br>
<p>The anime. Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">PATCH api/v1/anime/{anime}/episodes-watched/{episodesWatched}</h2>

<p>
</p>



<span id="example-requests-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime/385/episodes-watched/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime/385/episodes-watched/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">
</span>
<span id="execution-results-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-" data-method="PATCH"
      data-path="api/v1/anime/{anime}/episodes-watched/{episodesWatched}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
                    onclick="tryItOut('PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
                    onclick="cancelTryOut('PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/v1/anime/{anime}/episodes-watched/{episodesWatched}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime"                data-endpoint="PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
               value="385"
               data-component="url">
    <br>
<p>The anime. Example: <code>385</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>episodesWatched</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="episodesWatched"                data-endpoint="PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-my-anime-list--status--">GET api/v1/my-anime-list/{status?}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-my-anime-list--status--">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/my-anime-list/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/my-anime-list/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-my-anime-list--status--">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-my-anime-list--status--" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-my-anime-list--status--"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-my-anime-list--status--"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-my-anime-list--status--" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-my-anime-list--status--">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-my-anime-list--status--" data-method="GET"
      data-path="api/v1/my-anime-list/{status?}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-my-anime-list--status--', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-my-anime-list--status--"
                    onclick="tryItOut('GETapi-v1-my-anime-list--status--');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-my-anime-list--status--"
                    onclick="cancelTryOut('GETapi-v1-my-anime-list--status--');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-my-anime-list--status--"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/my-anime-list/{status?}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-my-anime-list--status--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-my-anime-list--status--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-v1-my-anime-list--status--"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-favorites">GET api/v1/favorites</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-favorites">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-favorites">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-favorites" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-favorites"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-favorites"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-favorites" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-favorites">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-favorites" data-method="GET"
      data-path="api/v1/favorites"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-favorites', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-favorites"
                    onclick="tryItOut('GETapi-v1-favorites');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-favorites"
                    onclick="cancelTryOut('GETapi-v1-favorites');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-favorites"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/favorites</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-favorites">POST api/v1/favorites</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-favorites">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"anime_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "anime_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-favorites">
</span>
<span id="execution-results-POSTapi-v1-favorites" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-favorites"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-favorites"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-favorites" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-favorites">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-favorites" data-method="POST"
      data-path="api/v1/favorites"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-favorites', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-favorites"
                    onclick="tryItOut('POSTapi-v1-favorites');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-favorites"
                    onclick="cancelTryOut('POSTapi-v1-favorites');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-favorites"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/favorites</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-favorites"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>anime_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="anime_id"                data-endpoint="POSTapi-v1-favorites"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the anime table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-favorites--animeId-">DELETE api/v1/favorites/{animeId}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-favorites--animeId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-favorites--animeId-">
</span>
<span id="execution-results-DELETEapi-v1-favorites--animeId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-favorites--animeId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-favorites--animeId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-favorites--animeId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-favorites--animeId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-favorites--animeId-" data-method="DELETE"
      data-path="api/v1/favorites/{animeId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-favorites--animeId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-favorites--animeId-"
                    onclick="tryItOut('DELETEapi-v1-favorites--animeId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-favorites--animeId-"
                    onclick="cancelTryOut('DELETEapi-v1-favorites--animeId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-favorites--animeId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/favorites/{animeId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-favorites--animeId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-favorites--animeId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>animeId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="animeId"                data-endpoint="DELETEapi-v1-favorites--animeId-"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-favorites--animeId--check">GET api/v1/favorites/{animeId}/check</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-favorites--animeId--check">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites/architecto/check" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/favorites/architecto/check"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-favorites--animeId--check">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-favorites--animeId--check" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-favorites--animeId--check"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-favorites--animeId--check"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-favorites--animeId--check" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-favorites--animeId--check">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-favorites--animeId--check" data-method="GET"
      data-path="api/v1/favorites/{animeId}/check"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-favorites--animeId--check', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-favorites--animeId--check"
                    onclick="tryItOut('GETapi-v1-favorites--animeId--check');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-favorites--animeId--check"
                    onclick="cancelTryOut('GETapi-v1-favorites--animeId--check');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-favorites--animeId--check"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/favorites/{animeId}/check</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-favorites--animeId--check"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-favorites--animeId--check"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>animeId</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="animeId"                data-endpoint="GETapi-v1-favorites--animeId--check"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-watch-history">GET api/v1/watch-history</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-watch-history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-watch-history">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-watch-history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-watch-history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-watch-history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-watch-history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-watch-history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-watch-history" data-method="GET"
      data-path="api/v1/watch-history"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-watch-history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-watch-history"
                    onclick="tryItOut('GETapi-v1-watch-history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-watch-history"
                    onclick="cancelTryOut('GETapi-v1-watch-history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-watch-history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/watch-history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-watch-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-watch-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-watch-history">POST api/v1/watch-history</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-watch-history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"episode_id\": \"architecto\",
    \"progress\": 39,
    \"completed\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "episode_id": "architecto",
    "progress": 39,
    "completed": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-watch-history">
</span>
<span id="execution-results-POSTapi-v1-watch-history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-watch-history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-watch-history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-watch-history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-watch-history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-watch-history" data-method="POST"
      data-path="api/v1/watch-history"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-watch-history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-watch-history"
                    onclick="tryItOut('POSTapi-v1-watch-history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-watch-history"
                    onclick="cancelTryOut('POSTapi-v1-watch-history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-watch-history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/watch-history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-watch-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-watch-history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>episode_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="episode_id"                data-endpoint="POSTapi-v1-watch-history"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the episodes table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>progress</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="progress"                data-endpoint="POSTapi-v1-watch-history"
               value="39"
               data-component="body">
    <br>
<p>Must be at least 0. Example: <code>39</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>completed</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-v1-watch-history" style="display: none">
            <input type="radio" name="completed"
                   value="true"
                   data-endpoint="POSTapi-v1-watch-history"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-v1-watch-history" style="display: none">
            <input type="radio" name="completed"
                   value="false"
                   data-endpoint="POSTapi-v1-watch-history"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-watch-history--id-">GET api/v1/watch-history/{id}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-watch-history--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-watch-history--id-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-watch-history--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-watch-history--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-watch-history--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-watch-history--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-watch-history--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-watch-history--id-" data-method="GET"
      data-path="api/v1/watch-history/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-watch-history--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-watch-history--id-"
                    onclick="tryItOut('GETapi-v1-watch-history--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-watch-history--id-"
                    onclick="cancelTryOut('GETapi-v1-watch-history--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-watch-history--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/watch-history/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-watch-history--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-watch-history--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="GETapi-v1-watch-history--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the watch history. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-v1-watch-history--id-">DELETE api/v1/watch-history/{id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-watch-history--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-watch-history--id-">
</span>
<span id="execution-results-DELETEapi-v1-watch-history--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-watch-history--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-watch-history--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-watch-history--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-watch-history--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-watch-history--id-" data-method="DELETE"
      data-path="api/v1/watch-history/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-watch-history--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-watch-history--id-"
                    onclick="tryItOut('DELETEapi-v1-watch-history--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-watch-history--id-"
                    onclick="cancelTryOut('DELETEapi-v1-watch-history--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-watch-history--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/watch-history/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-watch-history--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-watch-history--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEapi-v1-watch-history--id-"
               value="architecto"
               data-component="url">
    <br>
<p>The ID of the watch history. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-watch-history-anime--animeId--history">GET api/v1/watch-history/anime/{animeId}/history</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-watch-history-anime--animeId--history">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/anime/385/history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/anime/385/history"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-watch-history-anime--animeId--history">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-watch-history-anime--animeId--history" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-watch-history-anime--animeId--history"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-watch-history-anime--animeId--history"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-watch-history-anime--animeId--history" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-watch-history-anime--animeId--history">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-watch-history-anime--animeId--history" data-method="GET"
      data-path="api/v1/watch-history/anime/{animeId}/history"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-watch-history-anime--animeId--history', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-watch-history-anime--animeId--history"
                    onclick="tryItOut('GETapi-v1-watch-history-anime--animeId--history');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-watch-history-anime--animeId--history"
                    onclick="cancelTryOut('GETapi-v1-watch-history-anime--animeId--history');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-watch-history-anime--animeId--history"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/watch-history/anime/{animeId}/history</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-watch-history-anime--animeId--history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-watch-history-anime--animeId--history"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>animeId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="animeId"                data-endpoint="GETapi-v1-watch-history-anime--animeId--history"
               value="385"
               data-component="url">
    <br>
<p>Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-watch-history-anime--animeId--last-episode">GET api/v1/watch-history/anime/{animeId}/last-episode</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-watch-history-anime--animeId--last-episode">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/anime/385/last-episode" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/watch-history/anime/385/last-episode"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-watch-history-anime--animeId--last-episode">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-watch-history-anime--animeId--last-episode" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-watch-history-anime--animeId--last-episode"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-watch-history-anime--animeId--last-episode"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-watch-history-anime--animeId--last-episode" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-watch-history-anime--animeId--last-episode">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-watch-history-anime--animeId--last-episode" data-method="GET"
      data-path="api/v1/watch-history/anime/{animeId}/last-episode"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-watch-history-anime--animeId--last-episode', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-watch-history-anime--animeId--last-episode"
                    onclick="tryItOut('GETapi-v1-watch-history-anime--animeId--last-episode');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-watch-history-anime--animeId--last-episode"
                    onclick="cancelTryOut('GETapi-v1-watch-history-anime--animeId--last-episode');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-watch-history-anime--animeId--last-episode"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/watch-history/anime/{animeId}/last-episode</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-watch-history-anime--animeId--last-episode"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-watch-history-anime--animeId--last-episode"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>animeId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="animeId"                data-endpoint="GETapi-v1-watch-history-anime--animeId--last-episode"
               value="385"
               data-component="url">
    <br>
<p>Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-ratings">GET api/v1/ratings</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-ratings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-ratings">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-ratings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-ratings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-ratings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-ratings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-ratings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-ratings" data-method="GET"
      data-path="api/v1/ratings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-ratings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-ratings"
                    onclick="tryItOut('GETapi-v1-ratings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-ratings"
                    onclick="cancelTryOut('GETapi-v1-ratings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-ratings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/ratings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-ratings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-ratings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-POSTapi-v1-ratings">POST api/v1/ratings</h2>

<p>
</p>



<span id="example-requests-POSTapi-v1-ratings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"anime_id\": 16,
    \"rating\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "anime_id": 16,
    "rating": 2
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-ratings">
</span>
<span id="execution-results-POSTapi-v1-ratings" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-ratings"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-ratings"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-ratings" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-ratings">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-ratings" data-method="POST"
      data-path="api/v1/ratings"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-ratings', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-ratings"
                    onclick="tryItOut('POSTapi-v1-ratings');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-ratings"
                    onclick="cancelTryOut('POSTapi-v1-ratings');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-ratings"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/ratings</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-ratings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-ratings"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>anime_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime_id"                data-endpoint="POSTapi-v1-ratings"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the anime table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>rating</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating"                data-endpoint="POSTapi-v1-ratings"
               value="2"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 5. Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-v1-ratings--rating_id-">DELETE api/v1/ratings/{rating_id}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-v1-ratings--rating_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-v1-ratings--rating_id-">
</span>
<span id="execution-results-DELETEapi-v1-ratings--rating_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-v1-ratings--rating_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-ratings--rating_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-v1-ratings--rating_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-ratings--rating_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-v1-ratings--rating_id-" data-method="DELETE"
      data-path="api/v1/ratings/{rating_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-ratings--rating_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-v1-ratings--rating_id-"
                    onclick="tryItOut('DELETEapi-v1-ratings--rating_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-v1-ratings--rating_id-"
                    onclick="cancelTryOut('DELETEapi-v1-ratings--rating_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-v1-ratings--rating_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/v1/ratings/{rating_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-v1-ratings--rating_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-v1-ratings--rating_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>rating_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="rating_id"                data-endpoint="DELETEapi-v1-ratings--rating_id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the rating. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-ratings-anime--animeId-">GET api/v1/ratings/anime/{animeId}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-ratings-anime--animeId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings/anime/385" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/ratings/anime/385"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-ratings-anime--animeId-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-ratings-anime--animeId-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-ratings-anime--animeId-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-ratings-anime--animeId-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-ratings-anime--animeId-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-ratings-anime--animeId-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-ratings-anime--animeId-" data-method="GET"
      data-path="api/v1/ratings/anime/{animeId}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-ratings-anime--animeId-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-ratings-anime--animeId-"
                    onclick="tryItOut('GETapi-v1-ratings-anime--animeId-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-ratings-anime--animeId-"
                    onclick="cancelTryOut('GETapi-v1-ratings-anime--animeId-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-ratings-anime--animeId-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/ratings/anime/{animeId}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-ratings-anime--animeId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-ratings-anime--animeId-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>animeId</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="animeId"                data-endpoint="GETapi-v1-ratings-anime--animeId-"
               value="385"
               data-component="url">
    <br>
<p>Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-anime-list--status--">GET api/v1/anime-list/{status?}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-anime-list--status--">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-anime-list--status--">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-anime-list--status--" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-anime-list--status--"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-anime-list--status--"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-anime-list--status--" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-anime-list--status--">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-anime-list--status--" data-method="GET"
      data-path="api/v1/anime-list/{status?}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-anime-list--status--', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-anime-list--status--"
                    onclick="tryItOut('GETapi-v1-anime-list--status--');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-anime-list--status--"
                    onclick="cancelTryOut('GETapi-v1-anime-list--status--');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-anime-list--status--"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/anime-list/{status?}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-anime-list--status--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-anime-list--status--"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-v1-anime-list--status--"
               value="architecto"
               data-component="url">
    <br>
<p>Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-anime-list-anime--anime--status">GET api/v1/anime-list/anime/{anime}/status</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-anime-list-anime--anime--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/anime/385/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/anime/385/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-anime-list-anime--anime--status">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
x-frame-options: DENY
x-xss-protection: 1; mode=block
x-content-type-options: nosniff
referrer-policy: strict-origin-when-cross-origin
content-security-policy: default-src &#039;self&#039; *; script-src &#039;self&#039; &#039;unsafe-inline&#039; &#039;unsafe-eval&#039; https://unpkg.com https://cdn.tailwindcss.com; style-src &#039;self&#039; &#039;unsafe-inline&#039; https://fonts.googleapis.com https://cdn.tailwindcss.com; font-src &#039;self&#039; data: https://fonts.gstatic.com; img-src &#039;self&#039; data: *; connect-src &#039;self&#039; *; frame-ancestors &#039;none&#039;;
strict-transport-security: max-age=31536000; includeSubDomains
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-anime-list-anime--anime--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-anime-list-anime--anime--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-anime-list-anime--anime--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-anime-list-anime--anime--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-anime-list-anime--anime--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-anime-list-anime--anime--status" data-method="GET"
      data-path="api/v1/anime-list/anime/{anime}/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-anime-list-anime--anime--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-anime-list-anime--anime--status"
                    onclick="tryItOut('GETapi-v1-anime-list-anime--anime--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-anime-list-anime--anime--status"
                    onclick="cancelTryOut('GETapi-v1-anime-list-anime--anime--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-anime-list-anime--anime--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/anime-list/anime/{anime}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-anime-list-anime--anime--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-anime-list-anime--anime--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime"                data-endpoint="GETapi-v1-anime-list-anime--anime--status"
               value="385"
               data-component="url">
    <br>
<p>The anime. Example: <code>385</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-anime-list-anime--anime--status">PUT api/v1/anime-list/anime/{anime}/status</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-anime-list-anime--anime--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/anime/385/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"dropped\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/anime/385/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "dropped"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-anime-list-anime--anime--status">
</span>
<span id="execution-results-PUTapi-v1-anime-list-anime--anime--status" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-anime-list-anime--anime--status"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-anime-list-anime--anime--status"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-anime-list-anime--anime--status" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-anime-list-anime--anime--status">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-anime-list-anime--anime--status" data-method="PUT"
      data-path="api/v1/anime-list/anime/{anime}/status"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-anime-list-anime--anime--status', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-anime-list-anime--anime--status"
                    onclick="tryItOut('PUTapi-v1-anime-list-anime--anime--status');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-anime-list-anime--anime--status"
                    onclick="cancelTryOut('PUTapi-v1-anime-list-anime--anime--status');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-anime-list-anime--anime--status"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/anime-list/anime/{anime}/status</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-anime-list-anime--anime--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-anime-list-anime--anime--status"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime"                data-endpoint="PUTapi-v1-anime-list-anime--anime--status"
               value="385"
               data-component="url">
    <br>
<p>The anime. Example: <code>385</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-v1-anime-list-anime--anime--status"
               value="dropped"
               data-component="body">
    <br>
<p>Example: <code>dropped</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>watching</code></li> <li><code>planned</code></li> <li><code>completed</code></li> <li><code>on_hold</code></li> <li><code>dropped</code></li> <li><code>not_watching</code></li></ul>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-v1-anime-list-anime--anime--watched">PUT api/v1/anime-list/anime/{anime}/watched</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-anime-list-anime--anime--watched">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/anime/385/watched" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "https://leanna-superurgent-unfearfully.ngrok-free.dev/api/v1/anime-list/anime/385/watched"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PUT",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-v1-anime-list-anime--anime--watched">
</span>
<span id="execution-results-PUTapi-v1-anime-list-anime--anime--watched" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-v1-anime-list-anime--anime--watched"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-anime-list-anime--anime--watched"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-v1-anime-list-anime--anime--watched" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-anime-list-anime--anime--watched">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-v1-anime-list-anime--anime--watched" data-method="PUT"
      data-path="api/v1/anime-list/anime/{anime}/watched"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-anime-list-anime--anime--watched', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-v1-anime-list-anime--anime--watched"
                    onclick="tryItOut('PUTapi-v1-anime-list-anime--anime--watched');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-v1-anime-list-anime--anime--watched"
                    onclick="cancelTryOut('PUTapi-v1-anime-list-anime--anime--watched');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-v1-anime-list-anime--anime--watched"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/v1/anime-list/anime/{anime}/watched</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-v1-anime-list-anime--anime--watched"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-v1-anime-list-anime--anime--watched"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>anime</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="anime"                data-endpoint="PUTapi-v1-anime-list-anime--anime--watched"
               value="385"
               data-component="url">
    <br>
<p>The anime. Example: <code>385</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
