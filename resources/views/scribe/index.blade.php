<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

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
        var tryItOutBaseUrl = "http://localhost";
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
    <strong>Base URL</strong>: <code>http://localhost</code>
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
    --get "http://localhost/api/documentation" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/documentation"
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
    &quot;message&quot;: &quot;Route [l5-swagger.default.docs] not defined.&quot;
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
    --get "http://localhost/api/oauth2-callback" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/oauth2-callback"
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
    --get "http://localhost/api/v1/public/anime" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/anime"
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
            &quot;id&quot;: 1,
            &quot;title&quot;: &quot;Attack on Titan&quot;,
            &quot;slug&quot;: &quot;attack-on-titan-16498&quot;,
            &quot;description&quot;: &quot;Several hundred years ago, humans were nearly exterminated by titans. Titans are typically several stories tall, seem to have no intelligence, devour human beings and, worst of all, seem to do it for the pleasure rather than as a food source. A small percentage of humanity survived by walling themselves in a city protected by extremely high walls, even taller than the biggest of titans.&lt;br&gt;&lt;br&gt;\r\nFlash forward to the present and the city has not seen a titan in over 100 years. Teenage boy Eren and his foster sister Mikasa witness something horrific as the city walls are destroyed by a colossal titan that appears out of thin air. As the smaller titans flood the city, the two kids watch in horror as their mother is eaten alive. Eren vows that he will murder every single titan and take revenge for all of mankind.&lt;br&gt;&lt;br&gt;\r\n(Source: MangaHelpers) &quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx16498-buvcRTBx4NSm.jpg&quot;,
            &quot;rating&quot;: &quot;8.50&quot;,
            &quot;year&quot;: 2013,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 25,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 933228,
            &quot;favorites&quot;: 57221,
            &quot;external_id&quot;: &quot;16498&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Kaiju&quot;,
                    &quot;slug&quot;: &quot;kaiju&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Memory Manipulation&quot;,
                    &quot;slug&quot;: &quot;memory-manipulation&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Steampunk&quot;,
                    &quot;slug&quot;: &quot;steampunk&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;name&quot;: &quot;Vore&quot;,
                    &quot;slug&quot;: &quot;vore&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Orphan&quot;,
                    &quot;slug&quot;: &quot;orphan&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Espionage&quot;,
                    &quot;slug&quot;: &quot;espionage&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cannibalism&quot;,
                    &quot;slug&quot;: &quot;cannibalism&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 27,
                    &quot;name&quot;: &quot;Suicide&quot;,
                    &quot;slug&quot;: &quot;suicide&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;name&quot;: &quot;Medieval&quot;,
                    &quot;slug&quot;: &quot;medieval&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 31,
                    &quot;name&quot;: &quot;Amnesia&quot;,
                    &quot;slug&quot;: &quot;amnesia&quot;
                },
                {
                    &quot;id&quot;: 32,
                    &quot;name&quot;: &quot;Rural&quot;,
                    &quot;slug&quot;: &quot;rural&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;Adoption&quot;,
                    &quot;slug&quot;: &quot;adoption&quot;
                },
                {
                    &quot;id&quot;: 36,
                    &quot;name&quot;: &quot;Yuri&quot;,
                    &quot;slug&quot;: &quot;yuri&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:36.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-02T14:01:59.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;title&quot;: &quot;Demon Slayer: Kimetsu no Yaiba&quot;,
            &quot;slug&quot;: &quot;demon-slayer-kimetsu-no-yaiba-101922&quot;,
            &quot;description&quot;: &quot;It is the Taisho Period in Japan. Tanjiro, a kindhearted boy who sells charcoal for a living, finds his family slaughtered by a demon. To make matters worse, his younger sister Nezuko, the sole survivor, has been transformed into a demon herself. Though devastated by this grim reality, Tanjiro resolves to become a &ldquo;demon slayer&rdquo; so that he can turn his sister back into a human, and kill the demon that massacred his family.&lt;br&gt;\n&lt;br&gt;\n(Source: Crunchyroll)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx101922-WBsBl0ClmgYL.jpg&quot;,
            &quot;rating&quot;: &quot;8.20&quot;,
            &quot;year&quot;: 2019,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 26,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 885877,
            &quot;favorites&quot;: 42598,
            &quot;external_id&quot;: &quot;101922&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Orphan&quot;,
                    &quot;slug&quot;: &quot;orphan&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 32,
                    &quot;name&quot;: &quot;Rural&quot;,
                    &quot;slug&quot;: &quot;rural&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Demons&quot;,
                    &quot;slug&quot;: &quot;demons&quot;
                },
                {
                    &quot;id&quot;: 40,
                    &quot;name&quot;: &quot;Vampire&quot;,
                    &quot;slug&quot;: &quot;vampire&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 42,
                    &quot;name&quot;: &quot;Monster Girl&quot;,
                    &quot;slug&quot;: &quot;monster-girl&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Mythology&quot;,
                    &quot;slug&quot;: &quot;mythology&quot;
                },
                {
                    &quot;id&quot;: 44,
                    &quot;name&quot;: &quot;Historical&quot;,
                    &quot;slug&quot;: &quot;historical&quot;
                },
                {
                    &quot;id&quot;: 45,
                    &quot;name&quot;: &quot;Rotoscoping&quot;,
                    &quot;slug&quot;: &quot;rotoscoping&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Body Horror&quot;,
                    &quot;slug&quot;: &quot;body-horror&quot;
                },
                {
                    &quot;id&quot;: 47,
                    &quot;name&quot;: &quot;Curses&quot;,
                    &quot;slug&quot;: &quot;curses&quot;
                },
                {
                    &quot;id&quot;: 48,
                    &quot;name&quot;: &quot;Chibi&quot;,
                    &quot;slug&quot;: &quot;chibi&quot;
                },
                {
                    &quot;id&quot;: 49,
                    &quot;name&quot;: &quot;Snowscape&quot;,
                    &quot;slug&quot;: &quot;snowscape&quot;
                },
                {
                    &quot;id&quot;: 50,
                    &quot;name&quot;: &quot;Animals&quot;,
                    &quot;slug&quot;: &quot;animals&quot;
                },
                {
                    &quot;id&quot;: 51,
                    &quot;name&quot;: &quot;Food&quot;,
                    &quot;slug&quot;: &quot;food&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-02T16:26:01.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;title&quot;: &quot;Death Note&quot;,
            &quot;slug&quot;: &quot;death-note-1535&quot;,
            &quot;description&quot;: &quot;Light Yagami is a genius high school student who is about to learn about life through a book of death. When a bored shinigami, a God of Death, named Ryuk drops a black notepad called a &lt;i&gt;Death Note&lt;/i&gt;, Light receives power over life and death with the stroke of a pen. Determined to use this dark gift for the best, Light sets out to rid the world of evil&hellip; namely, the people he believes to be evil. Should anyone hold such power?&lt;br&gt;\n&lt;br&gt;\nThe consequences of Light&rsquo;s actions will set the world ablaze.&lt;br&gt;\n&lt;br&gt;\n(Source: Viz Media)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx1535-kUgkcrfOrkUM.jpg&quot;,
            &quot;rating&quot;: &quot;8.40&quot;,
            &quot;year&quot;: 2006,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 37,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 850034,
            &quot;favorites&quot;: 45228,
            &quot;external_id&quot;: &quot;1535&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Memory Manipulation&quot;,
                    &quot;slug&quot;: &quot;memory-manipulation&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Espionage&quot;,
                    &quot;slug&quot;: &quot;espionage&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 27,
                    &quot;name&quot;: &quot;Suicide&quot;,
                    &quot;slug&quot;: &quot;suicide&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 31,
                    &quot;name&quot;: &quot;Amnesia&quot;,
                    &quot;slug&quot;: &quot;amnesia&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 52,
                    &quot;name&quot;: &quot;Psychological&quot;,
                    &quot;slug&quot;: &quot;psychological&quot;
                },
                {
                    &quot;id&quot;: 53,
                    &quot;name&quot;: &quot;Thriller&quot;,
                    &quot;slug&quot;: &quot;thriller&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 55,
                    &quot;name&quot;: &quot;Detective&quot;,
                    &quot;slug&quot;: &quot;detective&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 57,
                    &quot;name&quot;: &quot;Police&quot;,
                    &quot;slug&quot;: &quot;police&quot;
                },
                {
                    &quot;id&quot;: 58,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 59,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 61,
                    &quot;name&quot;: &quot;Gods&quot;,
                    &quot;slug&quot;: &quot;gods&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 65,
                    &quot;name&quot;: &quot;Yandere&quot;,
                    &quot;slug&quot;: &quot;yandere&quot;
                },
                {
                    &quot;id&quot;: 66,
                    &quot;name&quot;: &quot;Acting&quot;,
                    &quot;slug&quot;: &quot;acting&quot;
                },
                {
                    &quot;id&quot;: 67,
                    &quot;name&quot;: &quot;Tennis&quot;,
                    &quot;slug&quot;: &quot;tennis&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;Assassins&quot;,
                    &quot;slug&quot;: &quot;assassins&quot;
                },
                {
                    &quot;id&quot;: 69,
                    &quot;name&quot;: &quot;Achronological Order&quot;,
                    &quot;slug&quot;: &quot;achronological-order&quot;
                },
                {
                    &quot;id&quot;: 70,
                    &quot;name&quot;: &quot;Asexual&quot;,
                    &quot;slug&quot;: &quot;asexual&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;title&quot;: &quot;JUJUTSU KAISEN&quot;,
            &quot;slug&quot;: &quot;jujutsu-kaisen-113415&quot;,
            &quot;description&quot;: &quot;A boy fights... for \&quot;the right death.\&quot;&lt;br&gt;\n&lt;br&gt;\nHardship, regret, shame: the negative feelings that humans feel become Curses that lurk in our everyday lives. The Curses run rampant throughout the world, capable of leading people to terrible misfortune and even death. What&#039;s more, the Curses can only be exorcised by another Curse.&lt;br&gt;\n&lt;br&gt;\nItadori Yuji is a boy with tremendous physical strength, though he lives a completely ordinary high school life. One day, to save a friend who has been attacked by Curses, he eats the finger of the Double-Faced Specter, taking the Curse into his own soul. From then on, he shares one body with the Double-Faced Specter. Guided by the most powerful of sorcerers, Gojou Satoru, Itadori is admitted to the Tokyo Metropolitan Technical High School of Sorcery, an organization that fights the Curses... and thus begins the heroic tale of a boy who became a Curse to exorcise a Curse, a life from which he could never turn back.\n&lt;br&gt;&lt;br&gt;\n(Source: Crunchyroll)&lt;br&gt;\n&lt;br&gt;\n&lt;i&gt;Note: The first episode received an early web premiere on September 19th, 2020. The regular TV broadcast started on October 3rd, 2020.&lt;/i&gt;&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx113415-LHBAeoZDIsnF.jpg&quot;,
            &quot;rating&quot;: &quot;8.40&quot;,
            &quot;year&quot;: 2020,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 24,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 842056,
            &quot;favorites&quot;: 50157,
            &quot;external_id&quot;: &quot;113415&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Orphan&quot;,
                    &quot;slug&quot;: &quot;orphan&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Demons&quot;,
                    &quot;slug&quot;: &quot;demons&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Mythology&quot;,
                    &quot;slug&quot;: &quot;mythology&quot;
                },
                {
                    &quot;id&quot;: 45,
                    &quot;name&quot;: &quot;Rotoscoping&quot;,
                    &quot;slug&quot;: &quot;rotoscoping&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Body Horror&quot;,
                    &quot;slug&quot;: &quot;body-horror&quot;
                },
                {
                    &quot;id&quot;: 47,
                    &quot;name&quot;: &quot;Curses&quot;,
                    &quot;slug&quot;: &quot;curses&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 71,
                    &quot;name&quot;: &quot;Youkai&quot;,
                    &quot;slug&quot;: &quot;youkai&quot;
                },
                {
                    &quot;id&quot;: 72,
                    &quot;name&quot;: &quot;Exorcism&quot;,
                    &quot;slug&quot;: &quot;exorcism&quot;
                },
                {
                    &quot;id&quot;: 73,
                    &quot;name&quot;: &quot;Dissociative Identities&quot;,
                    &quot;slug&quot;: &quot;dissociative-identities&quot;
                },
                {
                    &quot;id&quot;: 74,
                    &quot;name&quot;: &quot;Magic&quot;,
                    &quot;slug&quot;: &quot;magic&quot;
                },
                {
                    &quot;id&quot;: 75,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 78,
                    &quot;name&quot;: &quot;Anthropomorphism&quot;,
                    &quot;slug&quot;: &quot;anthropomorphism&quot;
                },
                {
                    &quot;id&quot;: 79,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 80,
                    &quot;name&quot;: &quot;Surreal Comedy&quot;,
                    &quot;slug&quot;: &quot;surreal-comedy&quot;
                },
                {
                    &quot;id&quot;: 81,
                    &quot;name&quot;: &quot;Twins&quot;,
                    &quot;slug&quot;: &quot;twins&quot;
                },
                {
                    &quot;id&quot;: 82,
                    &quot;name&quot;: &quot;Boarding School&quot;,
                    &quot;slug&quot;: &quot;boarding-school&quot;
                },
                {
                    &quot;id&quot;: 83,
                    &quot;name&quot;: &quot;Baseball&quot;,
                    &quot;slug&quot;: &quot;baseball&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T19:57:35.000000Z&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;title&quot;: &quot;My Hero Academia&quot;,
            &quot;slug&quot;: &quot;my-hero-academia-21459&quot;,
            &quot;description&quot;: &quot;What would the world be like if 80 percent of the population manifested extraordinary superpowers called &ldquo;Quirks&rdquo; at age four? Heroes and villains would be battling it out everywhere! Becoming a hero would mean learning to use your power, but where would you go to study? U.A. High&#039;s Hero Program of course! But what would you do if you were one of the 20 percent who were born Quirkless?&lt;br&gt;&lt;br&gt;\n\nMiddle school student Izuku Midoriya wants to be a hero more than anything, but he hasn&#039;t got an ounce of power in him. With no chance of ever getting into the prestigious U.A. High School for budding heroes, his life is looking more and more like a dead end. Then an encounter with All Might, the greatest hero of them all gives him a chance to change his destiny&hellip;&lt;br&gt;&lt;br&gt;\n\n(Source: Viz Media)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21459-nYh85uj2Fuwr.jpg&quot;,
            &quot;rating&quot;: &quot;7.60&quot;,
            &quot;year&quot;: 2016,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 13,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 785707,
            &quot;favorites&quot;: 21066,
            &quot;external_id&quot;: &quot;21459&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 85,
                    &quot;name&quot;: &quot;Superhero&quot;,
                    &quot;slug&quot;: &quot;superhero&quot;
                },
                {
                    &quot;id&quot;: 86,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 87,
                    &quot;name&quot;: &quot;Cultivation&quot;,
                    &quot;slug&quot;: &quot;cultivation&quot;
                },
                {
                    &quot;id&quot;: 88,
                    &quot;name&quot;: &quot;Prison&quot;,
                    &quot;slug&quot;: &quot;prison&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:40.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T23:00:06.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;title&quot;: &quot;Hunter x Hunter (2011)&quot;,
            &quot;slug&quot;: &quot;hunter-x-hunter-2011-11061&quot;,
            &quot;description&quot;: &quot;A new adaption of the manga of the same name by Togashi Yoshihiro.&lt;br&gt;&lt;br&gt;\nA Hunter is one who travels the world doing all sorts of dangerous tasks. From capturing criminals to searching deep within uncharted lands for any lost treasures. Gon is a young boy whose father disappeared long ago, being a Hunter. He believes if he could also follow his father&#039;s path, he could one day reunite with him.&lt;br&gt;&lt;br&gt;\nAfter becoming 12, Gon leaves his home and takes on the task of entering the Hunter exam, notorious for its low success rate and high probability of death to become an official Hunter. He befriends the revenge-driven Kurapika, the doctor-to-be Leorio and the rebellious ex-assassin Killua in the exam, with their friendship prevailing throughout the many trials and threats they come upon taking on the dangerous career of a Hunter.&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx11061-y5gsT1hoHuHw.png&quot;,
            &quot;rating&quot;: &quot;8.90&quot;,
            &quot;year&quot;: 2011,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 148,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 750669,
            &quot;favorites&quot;: 71118,
            &quot;external_id&quot;: &quot;11061&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Body Horror&quot;,
                    &quot;slug&quot;: &quot;body-horror&quot;
                },
                {
                    &quot;id&quot;: 50,
                    &quot;name&quot;: &quot;Animals&quot;,
                    &quot;slug&quot;: &quot;animals&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 59,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 65,
                    &quot;name&quot;: &quot;Yandere&quot;,
                    &quot;slug&quot;: &quot;yandere&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;Assassins&quot;,
                    &quot;slug&quot;: &quot;assassins&quot;
                },
                {
                    &quot;id&quot;: 75,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 78,
                    &quot;name&quot;: &quot;Anthropomorphism&quot;,
                    &quot;slug&quot;: &quot;anthropomorphism&quot;
                },
                {
                    &quot;id&quot;: 89,
                    &quot;name&quot;: &quot;Chimera&quot;,
                    &quot;slug&quot;: &quot;chimera&quot;
                },
                {
                    &quot;id&quot;: 90,
                    &quot;name&quot;: &quot;Virtual World&quot;,
                    &quot;slug&quot;: &quot;virtual-world&quot;
                },
                {
                    &quot;id&quot;: 91,
                    &quot;name&quot;: &quot;Environmental&quot;,
                    &quot;slug&quot;: &quot;environmental&quot;
                },
                {
                    &quot;id&quot;: 92,
                    &quot;name&quot;: &quot;Mafia&quot;,
                    &quot;slug&quot;: &quot;mafia&quot;
                },
                {
                    &quot;id&quot;: 93,
                    &quot;name&quot;: &quot;Gangs&quot;,
                    &quot;slug&quot;: &quot;gangs&quot;
                },
                {
                    &quot;id&quot;: 94,
                    &quot;name&quot;: &quot;Card Battle&quot;,
                    &quot;slug&quot;: &quot;card-battle&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 96,
                    &quot;name&quot;: &quot;Shogi&quot;,
                    &quot;slug&quot;: &quot;shogi&quot;
                },
                {
                    &quot;id&quot;: 97,
                    &quot;name&quot;: &quot;Video Games&quot;,
                    &quot;slug&quot;: &quot;video-games&quot;
                },
                {
                    &quot;id&quot;: 98,
                    &quot;name&quot;: &quot;Transgender&quot;,
                    &quot;slug&quot;: &quot;transgender&quot;
                },
                {
                    &quot;id&quot;: 99,
                    &quot;name&quot;: &quot;Board Game&quot;,
                    &quot;slug&quot;: &quot;board-game&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:40.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T23:00:06.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;title&quot;: &quot;One-Punch Man&quot;,
            &quot;slug&quot;: &quot;one-punch-man-21087&quot;,
            &quot;description&quot;: &quot;Saitama has a rather peculiar hobby, being a superhero, but despite his heroic deeds and superhuman abilities, a shadow looms over his life. He&#039;s become much too powerful, to the point that every opponent ends up defeated with a single punch.\n&lt;br&gt;&lt;br&gt;\nThe lack of challenge has driven him into a state of apathy, as he watches his life pass by having lost all enthusiasm, at least until he&#039;s unwillingly thrust in the role of being a mentor to the young and revenge-driven Genos.   \n\n&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21087-B5DHjqZ3kW4b.jpg&quot;,
            &quot;rating&quot;: &quot;5.00&quot;,
            &quot;year&quot;: 2015,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 12,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 695903,
            &quot;favorites&quot;: 25287,
            &quot;external_id&quot;: &quot;21087&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Kaiju&quot;,
                    &quot;slug&quot;: &quot;kaiju&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Demons&quot;,
                    &quot;slug&quot;: &quot;demons&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 61,
                    &quot;name&quot;: &quot;Gods&quot;,
                    &quot;slug&quot;: &quot;gods&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 75,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 80,
                    &quot;name&quot;: &quot;Surreal Comedy&quot;,
                    &quot;slug&quot;: &quot;surreal-comedy&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 85,
                    &quot;name&quot;: &quot;Superhero&quot;,
                    &quot;slug&quot;: &quot;superhero&quot;
                },
                {
                    &quot;id&quot;: 87,
                    &quot;name&quot;: &quot;Cultivation&quot;,
                    &quot;slug&quot;: &quot;cultivation&quot;
                },
                {
                    &quot;id&quot;: 100,
                    &quot;name&quot;: &quot;Sci-Fi&quot;,
                    &quot;slug&quot;: &quot;sci-fi&quot;
                },
                {
                    &quot;id&quot;: 101,
                    &quot;name&quot;: &quot;Parody&quot;,
                    &quot;slug&quot;: &quot;parody&quot;
                },
                {
                    &quot;id&quot;: 102,
                    &quot;name&quot;: &quot;Satire&quot;,
                    &quot;slug&quot;: &quot;satire&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Cyborg&quot;,
                    &quot;slug&quot;: &quot;cyborg&quot;
                },
                {
                    &quot;id&quot;: 104,
                    &quot;name&quot;: &quot;Seinen&quot;,
                    &quot;slug&quot;: &quot;seinen&quot;
                },
                {
                    &quot;id&quot;: 105,
                    &quot;name&quot;: &quot;Aliens&quot;,
                    &quot;slug&quot;: &quot;aliens&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:41.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T20:19:33.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;title&quot;: &quot;Tokyo Ghoul&quot;,
            &quot;slug&quot;: &quot;tokyo-ghoul-20605&quot;,
            &quot;description&quot;: &quot;The suspense horror/dark fantasy story is set in Tokyo, which is haunted by mysterious \&quot;ghouls\&quot; who are devouring humans. People are gripped by the fear of these ghouls whose identities are masked in mystery. An ordinary college student named Kaneki encounters Rize, a girl who is an avid reader like him, at the caf&eacute; he frequents. Little does he realize that his fate will change overnight.\n&lt;br&gt;&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/medium/b20605-k665mVkSug8D.jpg&quot;,
            &quot;rating&quot;: &quot;7.60&quot;,
            &quot;year&quot;: 2014,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 12,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 664442,
            &quot;favorites&quot;: 18498,
            &quot;external_id&quot;: &quot;20605&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cannibalism&quot;,
                    &quot;slug&quot;: &quot;cannibalism&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Mythology&quot;,
                    &quot;slug&quot;: &quot;mythology&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Body Horror&quot;,
                    &quot;slug&quot;: &quot;body-horror&quot;
                },
                {
                    &quot;id&quot;: 52,
                    &quot;name&quot;: &quot;Psychological&quot;,
                    &quot;slug&quot;: &quot;psychological&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 55,
                    &quot;name&quot;: &quot;Detective&quot;,
                    &quot;slug&quot;: &quot;detective&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 57,
                    &quot;name&quot;: &quot;Police&quot;,
                    &quot;slug&quot;: &quot;police&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 104,
                    &quot;name&quot;: &quot;Seinen&quot;,
                    &quot;slug&quot;: &quot;seinen&quot;
                },
                {
                    &quot;id&quot;: 106,
                    &quot;name&quot;: &quot;Horror&quot;,
                    &quot;slug&quot;: &quot;horror&quot;
                },
                {
                    &quot;id&quot;: 107,
                    &quot;name&quot;: &quot;Torture&quot;,
                    &quot;slug&quot;: &quot;torture&quot;
                },
                {
                    &quot;id&quot;: 108,
                    &quot;name&quot;: &quot;College&quot;,
                    &quot;slug&quot;: &quot;college&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:42.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:42.000000Z&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;title&quot;: &quot;Attack on Titan Season 2&quot;,
            &quot;slug&quot;: &quot;attack-on-titan-season-2-20958&quot;,
            &quot;description&quot;: &quot;Eren Jaeger swore to wipe out every last Titan, but in a battle for his life he wound up becoming the thing he hates most. With his new powers, he fights for humanity&#039;s freedom facing the monsters that threaten his home. After a bittersweet victory against the Female Titan, Eren finds no time to rest&mdash;a horde of Titans is approaching Wall Rose and the battle for humanity continues!&lt;br&gt;&lt;br&gt;\n\n(Source: Funimation)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx20958-HuFJyr54Mmir.jpg&quot;,
            &quot;rating&quot;: &quot;8.50&quot;,
            &quot;year&quot;: 2017,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 12,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 657311,
            &quot;favorites&quot;: 14673,
            &quot;external_id&quot;: &quot;20958&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Kaiju&quot;,
                    &quot;slug&quot;: &quot;kaiju&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Steampunk&quot;,
                    &quot;slug&quot;: &quot;steampunk&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Espionage&quot;,
                    &quot;slug&quot;: &quot;espionage&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cannibalism&quot;,
                    &quot;slug&quot;: &quot;cannibalism&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;name&quot;: &quot;Medieval&quot;,
                    &quot;slug&quot;: &quot;medieval&quot;
                },
                {
                    &quot;id&quot;: 32,
                    &quot;name&quot;: &quot;Rural&quot;,
                    &quot;slug&quot;: &quot;rural&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 73,
                    &quot;name&quot;: &quot;Dissociative Identities&quot;,
                    &quot;slug&quot;: &quot;dissociative-identities&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 110,
                    &quot;name&quot;: &quot;Cult&quot;,
                    &quot;slug&quot;: &quot;cult&quot;
                },
                {
                    &quot;id&quot;: 111,
                    &quot;name&quot;: &quot;Matriarchy&quot;,
                    &quot;slug&quot;: &quot;matriarchy&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:42.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:42.000000Z&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;title&quot;: &quot;ONE PIECE&quot;,
            &quot;slug&quot;: &quot;one-piece-21&quot;,
            &quot;description&quot;: &quot;Gold Roger was known as the Pirate King, the strongest and most infamous being to have sailed the Grand Line. The capture and death of Roger by the World Government brought a change throughout the world. His last words before his death revealed the location of the greatest treasure in the world, One Piece. It was this revelation that brought about the Grand Age of Pirates, men who dreamed of finding One Piece (which promises an unlimited amount of riches and fame), and quite possibly the most coveted of titles for the person who found it, the title of the Pirate King.&lt;br&gt;&lt;br&gt;\nEnter Monkey D. Luffy, a 17-year-old boy that defies your standard definition of a pirate. Rather than the popular persona of a wicked, hardened, toothless pirate who ransacks villages for fun, Luffy&rsquo;s reason for being a pirate is one of pure wonder; the thought of an exciting adventure and meeting new and intriguing people, along with finding One Piece, are his reasons of becoming a pirate. Following in the footsteps of his childhood hero, Luffy and his crew travel across the Grand Line, experiencing crazy adventures, unveiling dark mysteries and battling strong enemies, all in order to reach One Piece.&lt;br&gt;&lt;br&gt;\n&lt;b&gt;*This includes following special episodes:&lt;/b&gt;&lt;br&gt;\n- Chopperman to the Rescue! Protect the TV Station by the Shore! (Episode 336)&lt;br&gt;\n- The Strongest Tag-Team! Luffy and Toriko&#039;s Hard Struggle! (Episode 492)&lt;br&gt;\n- Team Formation! Save Chopper (Episode 542)&lt;br&gt;\n- History&#039;s Strongest Collaboration vs. Glutton of the Sea (Episode 590)&lt;br&gt;\n- 20th Anniversary! Special Romance Dawn (Episode 907)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21-ELSYx3yMPcKM.jpg&quot;,
            &quot;rating&quot;: &quot;1.00&quot;,
            &quot;year&quot;: 1999,
            &quot;status&quot;: &quot;releasing&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 0,
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
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 9,
                    &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
                    &quot;slug&quot;: &quot;post-apocalyptic&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Espionage&quot;,
                    &quot;slug&quot;: &quot;espionage&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;Adoption&quot;,
                    &quot;slug&quot;: &quot;adoption&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Demons&quot;,
                    &quot;slug&quot;: &quot;demons&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 42,
                    &quot;name&quot;: &quot;Monster Girl&quot;,
                    &quot;slug&quot;: &quot;monster-girl&quot;
                },
                {
                    &quot;id&quot;: 50,
                    &quot;name&quot;: &quot;Animals&quot;,
                    &quot;slug&quot;: &quot;animals&quot;
                },
                {
                    &quot;id&quot;: 51,
                    &quot;name&quot;: &quot;Food&quot;,
                    &quot;slug&quot;: &quot;food&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 58,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 59,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 61,
                    &quot;name&quot;: &quot;Gods&quot;,
                    &quot;slug&quot;: &quot;gods&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;Assassins&quot;,
                    &quot;slug&quot;: &quot;assassins&quot;
                },
                {
                    &quot;id&quot;: 70,
                    &quot;name&quot;: &quot;Asexual&quot;,
                    &quot;slug&quot;: &quot;asexual&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 78,
                    &quot;name&quot;: &quot;Anthropomorphism&quot;,
                    &quot;slug&quot;: &quot;anthropomorphism&quot;
                },
                {
                    &quot;id&quot;: 79,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 88,
                    &quot;name&quot;: &quot;Prison&quot;,
                    &quot;slug&quot;: &quot;prison&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Cyborg&quot;,
                    &quot;slug&quot;: &quot;cyborg&quot;
                },
                {
                    &quot;id&quot;: 112,
                    &quot;name&quot;: &quot;Pirates&quot;,
                    &quot;slug&quot;: &quot;pirates&quot;
                },
                {
                    &quot;id&quot;: 113,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 114,
                    &quot;name&quot;: &quot;Ships&quot;,
                    &quot;slug&quot;: &quot;ships&quot;
                },
                {
                    &quot;id&quot;: 115,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 116,
                    &quot;name&quot;: &quot;War&quot;,
                    &quot;slug&quot;: &quot;war&quot;
                },
                {
                    &quot;id&quot;: 117,
                    &quot;name&quot;: &quot;Slavery&quot;,
                    &quot;slug&quot;: &quot;slavery&quot;
                },
                {
                    &quot;id&quot;: 118,
                    &quot;name&quot;: &quot;Lost Civilization&quot;,
                    &quot;slug&quot;: &quot;lost-civilization&quot;
                },
                {
                    &quot;id&quot;: 119,
                    &quot;name&quot;: &quot;Monster Boy&quot;,
                    &quot;slug&quot;: &quot;monster-boy&quot;
                },
                {
                    &quot;id&quot;: 120,
                    &quot;name&quot;: &quot;Robots&quot;,
                    &quot;slug&quot;: &quot;robots&quot;
                },
                {
                    &quot;id&quot;: 121,
                    &quot;name&quot;: &quot;Medicine&quot;,
                    &quot;slug&quot;: &quot;medicine&quot;
                },
                {
                    &quot;id&quot;: 122,
                    &quot;name&quot;: &quot;Samurai&quot;,
                    &quot;slug&quot;: &quot;samurai&quot;
                },
                {
                    &quot;id&quot;: 123,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 124,
                    &quot;name&quot;: &quot;Desert&quot;,
                    &quot;slug&quot;: &quot;desert&quot;
                },
                {
                    &quot;id&quot;: 125,
                    &quot;name&quot;: &quot;Skeleton&quot;,
                    &quot;slug&quot;: &quot;skeleton&quot;
                },
                {
                    &quot;id&quot;: 126,
                    &quot;name&quot;: &quot;Anachronism&quot;,
                    &quot;slug&quot;: &quot;anachronism&quot;
                },
                {
                    &quot;id&quot;: 127,
                    &quot;name&quot;: &quot;Dragons&quot;,
                    &quot;slug&quot;: &quot;dragons&quot;
                },
                {
                    &quot;id&quot;: 128,
                    &quot;name&quot;: &quot;Marriage&quot;,
                    &quot;slug&quot;: &quot;marriage&quot;
                },
                {
                    &quot;id&quot;: 129,
                    &quot;name&quot;: &quot;Artificial Intelligence&quot;,
                    &quot;slug&quot;: &quot;artificial-intelligence&quot;
                },
                {
                    &quot;id&quot;: 130,
                    &quot;name&quot;: &quot;Nudity&quot;,
                    &quot;slug&quot;: &quot;nudity&quot;
                },
                {
                    &quot;id&quot;: 131,
                    &quot;name&quot;: &quot;Drugs&quot;,
                    &quot;slug&quot;: &quot;drugs&quot;
                },
                {
                    &quot;id&quot;: 132,
                    &quot;name&quot;: &quot;Fairy&quot;,
                    &quot;slug&quot;: &quot;fairy&quot;
                },
                {
                    &quot;id&quot;: 133,
                    &quot;name&quot;: &quot;Battle Royale&quot;,
                    &quot;slug&quot;: &quot;battle-royale&quot;
                },
                {
                    &quot;id&quot;: 134,
                    &quot;name&quot;: &quot;Aromantic&quot;,
                    &quot;slug&quot;: &quot;aromantic&quot;
                },
                {
                    &quot;id&quot;: 135,
                    &quot;name&quot;: &quot;Arranged Marriage&quot;,
                    &quot;slug&quot;: &quot;arranged-marriage&quot;
                },
                {
                    &quot;id&quot;: 136,
                    &quot;name&quot;: &quot;Mermaid&quot;,
                    &quot;slug&quot;: &quot;mermaid&quot;
                },
                {
                    &quot;id&quot;: 137,
                    &quot;name&quot;: &quot;Ninja&quot;,
                    &quot;slug&quot;: &quot;ninja&quot;
                },
                {
                    &quot;id&quot;: 138,
                    &quot;name&quot;: &quot;Gender Bending&quot;,
                    &quot;slug&quot;: &quot;gender-bending&quot;
                },
                {
                    &quot;id&quot;: 139,
                    &quot;name&quot;: &quot;Time Manipulation&quot;,
                    &quot;slug&quot;: &quot;time-manipulation&quot;
                },
                {
                    &quot;id&quot;: 140,
                    &quot;name&quot;: &quot;Clone&quot;,
                    &quot;slug&quot;: &quot;clone&quot;
                },
                {
                    &quot;id&quot;: 141,
                    &quot;name&quot;: &quot;Musical Theater&quot;,
                    &quot;slug&quot;: &quot;musical-theater&quot;
                },
                {
                    &quot;id&quot;: 142,
                    &quot;name&quot;: &quot;Zombie&quot;,
                    &quot;slug&quot;: &quot;zombie&quot;
                },
                {
                    &quot;id&quot;: 143,
                    &quot;name&quot;: &quot;Kabuki&quot;,
                    &quot;slug&quot;: &quot;kabuki&quot;
                },
                {
                    &quot;id&quot;: 144,
                    &quot;name&quot;: &quot;Angels&quot;,
                    &quot;slug&quot;: &quot;angels&quot;
                },
                {
                    &quot;id&quot;: 145,
                    &quot;name&quot;: &quot;Trains&quot;,
                    &quot;slug&quot;: &quot;trains&quot;
                },
                {
                    &quot;id&quot;: 146,
                    &quot;name&quot;: &quot;LGBTQ+ Themes&quot;,
                    &quot;slug&quot;: &quot;lgbtq-themes&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:43.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-02T10:42:52.000000Z&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;title&quot;: &quot;Fullmetal Alchemist: Brotherhood&quot;,
            &quot;slug&quot;: &quot;fullmetal-alchemist-brotherhood-5114&quot;,
            &quot;description&quot;: &quot;\&quot;In order for something to be obtained, something of equal value must be lost.\&quot;\n&lt;br&gt;&lt;br&gt;\nAlchemy is bound by this Law of Equivalent Exchange&mdash;something the young brothers Edward and Alphonse Elric only realize after attempting human transmutation: the one forbidden act of alchemy. They pay a terrible price for their transgression&mdash;Edward loses his left leg, Alphonse his physical body. It is only by the desperate sacrifice of Edward&#039;s right arm that he is able to affix Alphonse&#039;s soul to a suit of armor. Devastated and alone, it is the hope that they would both eventually return to their original bodies that gives Edward the inspiration to obtain metal limbs called \&quot;automail\&quot; and become a state alchemist, the Fullmetal Alchemist.\n&lt;br&gt;&lt;br&gt;\nThree years of searching later, the brothers seek the Philosopher&#039;s Stone, a mythical relic that allows an alchemist to overcome the Law of Equivalent Exchange. Even with military allies Colonel Roy Mustang, Lieutenant Riza Hawkeye, and Lieutenant Colonel Maes Hughes on their side, the brothers find themselves caught up in a nationwide conspiracy that leads them not only to the true nature of the elusive Philosopher&#039;s Stone, but their country&#039;s murky history as well. In between finding a serial killer and racing against time, Edward and Alphonse must ask themselves if what they are doing will make them human again... or take away their humanity.\n&lt;br&gt;&lt;br&gt;\n(Source: MAL Rewrite)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx5114-nSWCgQlmOMtj.jpg&quot;,
            &quot;rating&quot;: &quot;9.00&quot;,
            &quot;year&quot;: 2009,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 64,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 648152,
            &quot;favorites&quot;: 53564,
            &quot;external_id&quot;: &quot;5114&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Steampunk&quot;,
                    &quot;slug&quot;: &quot;steampunk&quot;
                },
                {
                    &quot;id&quot;: 19,
                    &quot;name&quot;: &quot;Vore&quot;,
                    &quot;slug&quot;: &quot;vore&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 23,
                    &quot;name&quot;: &quot;Cannibalism&quot;,
                    &quot;slug&quot;: &quot;cannibalism&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 35,
                    &quot;name&quot;: &quot;Adoption&quot;,
                    &quot;slug&quot;: &quot;adoption&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Demons&quot;,
                    &quot;slug&quot;: &quot;demons&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Body Horror&quot;,
                    &quot;slug&quot;: &quot;body-horror&quot;
                },
                {
                    &quot;id&quot;: 48,
                    &quot;name&quot;: &quot;Chibi&quot;,
                    &quot;slug&quot;: &quot;chibi&quot;
                },
                {
                    &quot;id&quot;: 49,
                    &quot;name&quot;: &quot;Snowscape&quot;,
                    &quot;slug&quot;: &quot;snowscape&quot;
                },
                {
                    &quot;id&quot;: 58,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 59,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 61,
                    &quot;name&quot;: &quot;Gods&quot;,
                    &quot;slug&quot;: &quot;gods&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 73,
                    &quot;name&quot;: &quot;Dissociative Identities&quot;,
                    &quot;slug&quot;: &quot;dissociative-identities&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 79,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 89,
                    &quot;name&quot;: &quot;Chimera&quot;,
                    &quot;slug&quot;: &quot;chimera&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 103,
                    &quot;name&quot;: &quot;Cyborg&quot;,
                    &quot;slug&quot;: &quot;cyborg&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 115,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 116,
                    &quot;name&quot;: &quot;War&quot;,
                    &quot;slug&quot;: &quot;war&quot;
                },
                {
                    &quot;id&quot;: 118,
                    &quot;name&quot;: &quot;Lost Civilization&quot;,
                    &quot;slug&quot;: &quot;lost-civilization&quot;
                },
                {
                    &quot;id&quot;: 123,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 124,
                    &quot;name&quot;: &quot;Desert&quot;,
                    &quot;slug&quot;: &quot;desert&quot;
                },
                {
                    &quot;id&quot;: 126,
                    &quot;name&quot;: &quot;Anachronism&quot;,
                    &quot;slug&quot;: &quot;anachronism&quot;
                },
                {
                    &quot;id&quot;: 145,
                    &quot;name&quot;: &quot;Trains&quot;,
                    &quot;slug&quot;: &quot;trains&quot;
                },
                {
                    &quot;id&quot;: 147,
                    &quot;name&quot;: &quot;Alchemy&quot;,
                    &quot;slug&quot;: &quot;alchemy&quot;
                },
                {
                    &quot;id&quot;: 148,
                    &quot;name&quot;: &quot;Foreign&quot;,
                    &quot;slug&quot;: &quot;foreign&quot;
                },
                {
                    &quot;id&quot;: 149,
                    &quot;name&quot;: &quot;Disability&quot;,
                    &quot;slug&quot;: &quot;disability&quot;
                },
                {
                    &quot;id&quot;: 150,
                    &quot;name&quot;: &quot;Necromancy&quot;,
                    &quot;slug&quot;: &quot;necromancy&quot;
                },
                {
                    &quot;id&quot;: 151,
                    &quot;name&quot;: &quot;Religion&quot;,
                    &quot;slug&quot;: &quot;religion&quot;
                },
                {
                    &quot;id&quot;: 152,
                    &quot;name&quot;: &quot;Tomboy&quot;,
                    &quot;slug&quot;: &quot;tomboy&quot;
                },
                {
                    &quot;id&quot;: 153,
                    &quot;name&quot;: &quot;Tanned Skin&quot;,
                    &quot;slug&quot;: &quot;tanned-skin&quot;
                },
                {
                    &quot;id&quot;: 154,
                    &quot;name&quot;: &quot;Tsundere&quot;,
                    &quot;slug&quot;: &quot;tsundere&quot;
                },
                {
                    &quot;id&quot;: 155,
                    &quot;name&quot;: &quot;Crossdressing&quot;,
                    &quot;slug&quot;: &quot;crossdressing&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:52.000000Z&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;title&quot;: &quot;Sword Art Online&quot;,
            &quot;slug&quot;: &quot;sword-art-online-11757&quot;,
            &quot;description&quot;: &quot;In the near future, a Virtual Reality Massive Multiplayer Online Role-Playing Game (VRMMORPG) called Sword Art Online has been released where players control their avatars with their bodies using a piece of technology called Nerve Gear. One day, players discover they cannot log out, as the game creator is holding them captive unless they reach the 100th floor of the game&#039;s tower and defeat the final boss. However, if they die in the game, they die in real life. Their struggle for survival starts now...&lt;br&gt;&lt;br&gt;\n(Source: Crunchyroll)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx11757-SxYDUzdr9rh2.jpg&quot;,
            &quot;rating&quot;: &quot;6.90&quot;,
            &quot;year&quot;: 2012,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 25,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 645858,
            &quot;favorites&quot;: 18536,
            &quot;external_id&quot;: &quot;11757&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;name&quot;: &quot;Medieval&quot;,
                    &quot;slug&quot;: &quot;medieval&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 31,
                    &quot;name&quot;: &quot;Amnesia&quot;,
                    &quot;slug&quot;: &quot;amnesia&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 88,
                    &quot;name&quot;: &quot;Prison&quot;,
                    &quot;slug&quot;: &quot;prison&quot;
                },
                {
                    &quot;id&quot;: 90,
                    &quot;name&quot;: &quot;Virtual World&quot;,
                    &quot;slug&quot;: &quot;virtual-world&quot;
                },
                {
                    &quot;id&quot;: 97,
                    &quot;name&quot;: &quot;Video Games&quot;,
                    &quot;slug&quot;: &quot;video-games&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 113,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 129,
                    &quot;name&quot;: &quot;Artificial Intelligence&quot;,
                    &quot;slug&quot;: &quot;artificial-intelligence&quot;
                },
                {
                    &quot;id&quot;: 132,
                    &quot;name&quot;: &quot;Fairy&quot;,
                    &quot;slug&quot;: &quot;fairy&quot;
                },
                {
                    &quot;id&quot;: 156,
                    &quot;name&quot;: &quot;Romance&quot;,
                    &quot;slug&quot;: &quot;romance&quot;
                },
                {
                    &quot;id&quot;: 157,
                    &quot;name&quot;: &quot;Isekai&quot;,
                    &quot;slug&quot;: &quot;isekai&quot;
                },
                {
                    &quot;id&quot;: 158,
                    &quot;name&quot;: &quot;Death Game&quot;,
                    &quot;slug&quot;: &quot;death-game&quot;
                },
                {
                    &quot;id&quot;: 159,
                    &quot;name&quot;: &quot;Rescue&quot;,
                    &quot;slug&quot;: &quot;rescue&quot;
                },
                {
                    &quot;id&quot;: 160,
                    &quot;name&quot;: &quot;Primarily Female Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-female-cast&quot;
                },
                {
                    &quot;id&quot;: 161,
                    &quot;name&quot;: &quot;Female Harem&quot;,
                    &quot;slug&quot;: &quot;female-harem&quot;
                },
                {
                    &quot;id&quot;: 162,
                    &quot;name&quot;: &quot;Fishing&quot;,
                    &quot;slug&quot;: &quot;fishing&quot;
                },
                {
                    &quot;id&quot;: 163,
                    &quot;name&quot;: &quot;Rape&quot;,
                    &quot;slug&quot;: &quot;rape&quot;
                },
                {
                    &quot;id&quot;: 164,
                    &quot;name&quot;: &quot;Inseki&quot;,
                    &quot;slug&quot;: &quot;inseki&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:52.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T23:00:14.000000Z&quot;
        },
        {
            &quot;id&quot;: 13,
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
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Kaiju&quot;,
                    &quot;slug&quot;: &quot;kaiju&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Orphan&quot;,
                    &quot;slug&quot;: &quot;orphan&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 41,
                    &quot;name&quot;: &quot;Travel&quot;,
                    &quot;slug&quot;: &quot;travel&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;Assassins&quot;,
                    &quot;slug&quot;: &quot;assassins&quot;
                },
                {
                    &quot;id&quot;: 75,
                    &quot;name&quot;: &quot;Martial Arts&quot;,
                    &quot;slug&quot;: &quot;martial-arts&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 78,
                    &quot;name&quot;: &quot;Anthropomorphism&quot;,
                    &quot;slug&quot;: &quot;anthropomorphism&quot;
                },
                {
                    &quot;id&quot;: 79,
                    &quot;name&quot;: &quot;Slapstick&quot;,
                    &quot;slug&quot;: &quot;slapstick&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 86,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 113,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 126,
                    &quot;name&quot;: &quot;Anachronism&quot;,
                    &quot;slug&quot;: &quot;anachronism&quot;
                },
                {
                    &quot;id&quot;: 133,
                    &quot;name&quot;: &quot;Battle Royale&quot;,
                    &quot;slug&quot;: &quot;battle-royale&quot;
                },
                {
                    &quot;id&quot;: 137,
                    &quot;name&quot;: &quot;Ninja&quot;,
                    &quot;slug&quot;: &quot;ninja&quot;
                },
                {
                    &quot;id&quot;: 138,
                    &quot;name&quot;: &quot;Gender Bending&quot;,
                    &quot;slug&quot;: &quot;gender-bending&quot;
                },
                {
                    &quot;id&quot;: 150,
                    &quot;name&quot;: &quot;Necromancy&quot;,
                    &quot;slug&quot;: &quot;necromancy&quot;
                },
                {
                    &quot;id&quot;: 165,
                    &quot;name&quot;: &quot;Criminal Organization&quot;,
                    &quot;slug&quot;: &quot;criminal-organization&quot;
                },
                {
                    &quot;id&quot;: 166,
                    &quot;name&quot;: &quot;Primarily Child Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-child-cast&quot;
                },
                {
                    &quot;id&quot;: 167,
                    &quot;name&quot;: &quot;Estranged Family&quot;,
                    &quot;slug&quot;: &quot;estranged-family&quot;
                },
                {
                    &quot;id&quot;: 168,
                    &quot;name&quot;: &quot;Love Triangle&quot;,
                    &quot;slug&quot;: &quot;love-triangle&quot;
                },
                {
                    &quot;id&quot;: 169,
                    &quot;name&quot;: &quot;Gambling&quot;,
                    &quot;slug&quot;: &quot;gambling&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:53.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-02T15:44:03.000000Z&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;title&quot;: &quot;Your Name.&quot;,
            &quot;slug&quot;: &quot;your-name-21519&quot;,
            &quot;description&quot;: &quot;Mitsuha Miyamizu, a high school girl, yearns to live the life of a boy in the bustling city of Tokyo&mdash;a dream that stands in stark contrast to her present life in the countryside. Meanwhile in the city, Taki Tachibana lives a busy life as a high school student while juggling his part-time job and hopes for a future in architecture.&lt;br&gt;\n&lt;br&gt;\nOne day, Mitsuha awakens in a room that is not her own and suddenly finds herself living the dream life in Tokyo&mdash;but in Taki&#039;s body! Elsewhere, Taki finds himself living Mitsuha&#039;s life in the humble countryside. In pursuit of an answer to this strange phenomenon, they begin to search for one another.&lt;br&gt;\n&lt;br&gt;\n&lt;i&gt;Kimi no Na wa.&lt;/i&gt; revolves around Mitsuha and Taki&#039;s actions, which begin to have a dramatic impact on each other&#039;s lives, weaving them into a fabric held together by fate and circumstance.&lt;br&gt;\n&lt;br&gt;\n(Source: MAL Rewrite)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21519-SUo3ZQuCbYhJ.png&quot;,
            &quot;rating&quot;: &quot;8.50&quot;,
            &quot;year&quot;: 2016,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;movie&quot;,
            &quot;number_of_episodes&quot;: 1,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 635461,
            &quot;favorites&quot;: 34491,
            &quot;external_id&quot;: &quot;21519&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Memory Manipulation&quot;,
                    &quot;slug&quot;: &quot;memory-manipulation&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 32,
                    &quot;name&quot;: &quot;Rural&quot;,
                    &quot;slug&quot;: &quot;rural&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 43,
                    &quot;name&quot;: &quot;Mythology&quot;,
                    &quot;slug&quot;: &quot;mythology&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 91,
                    &quot;name&quot;: &quot;Environmental&quot;,
                    &quot;slug&quot;: &quot;environmental&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 138,
                    &quot;name&quot;: &quot;Gender Bending&quot;,
                    &quot;slug&quot;: &quot;gender-bending&quot;
                },
                {
                    &quot;id&quot;: 139,
                    &quot;name&quot;: &quot;Time Manipulation&quot;,
                    &quot;slug&quot;: &quot;time-manipulation&quot;
                },
                {
                    &quot;id&quot;: 145,
                    &quot;name&quot;: &quot;Trains&quot;,
                    &quot;slug&quot;: &quot;trains&quot;
                },
                {
                    &quot;id&quot;: 156,
                    &quot;name&quot;: &quot;Romance&quot;,
                    &quot;slug&quot;: &quot;romance&quot;
                },
                {
                    &quot;id&quot;: 170,
                    &quot;name&quot;: &quot;Body Swapping&quot;,
                    &quot;slug&quot;: &quot;body-swapping&quot;
                },
                {
                    &quot;id&quot;: 171,
                    &quot;name&quot;: &quot;Alternate Universe&quot;,
                    &quot;slug&quot;: &quot;alternate-universe&quot;
                },
                {
                    &quot;id&quot;: 172,
                    &quot;name&quot;: &quot;Shrine Maiden&quot;,
                    &quot;slug&quot;: &quot;shrine-maiden&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:55.000000Z&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;title&quot;: &quot;A Silent Voice&quot;,
            &quot;slug&quot;: &quot;a-silent-voice-20954&quot;,
            &quot;description&quot;: &quot;After transferring into a new school, a deaf girl, Shouko Nishimiya, is bullied by the popular Shouya Ishida. As Shouya continues to bully Shouko, the class turns its back on him. Shouko transfers and Shouya grows up as an outcast. Alone and depressed, the regretful Shouya finds Shouko to make amends.\n&lt;br&gt;&lt;br&gt;\n(Source: Eleven Arts)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx20954-sYRfE5jQRtSB.jpg&quot;,
            &quot;rating&quot;: &quot;8.80&quot;,
            &quot;year&quot;: 2016,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;movie&quot;,
            &quot;number_of_episodes&quot;: 1,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 627140,
            &quot;favorites&quot;: 45037,
            &quot;external_id&quot;: &quot;20954&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 27,
                    &quot;name&quot;: &quot;Suicide&quot;,
                    &quot;slug&quot;: &quot;suicide&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 63,
                    &quot;name&quot;: &quot;Urban&quot;,
                    &quot;slug&quot;: &quot;urban&quot;
                },
                {
                    &quot;id&quot;: 64,
                    &quot;name&quot;: &quot;Unrequited Love&quot;,
                    &quot;slug&quot;: &quot;unrequited-love&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 86,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 149,
                    &quot;name&quot;: &quot;Disability&quot;,
                    &quot;slug&quot;: &quot;disability&quot;
                },
                {
                    &quot;id&quot;: 156,
                    &quot;name&quot;: &quot;Romance&quot;,
                    &quot;slug&quot;: &quot;romance&quot;
                },
                {
                    &quot;id&quot;: 173,
                    &quot;name&quot;: &quot;Slice of Life&quot;,
                    &quot;slug&quot;: &quot;slice-of-life&quot;
                },
                {
                    &quot;id&quot;: 174,
                    &quot;name&quot;: &quot;Rehabilitation&quot;,
                    &quot;slug&quot;: &quot;rehabilitation&quot;
                },
                {
                    &quot;id&quot;: 175,
                    &quot;name&quot;: &quot;Language Barrier&quot;,
                    &quot;slug&quot;: &quot;language-barrier&quot;
                },
                {
                    &quot;id&quot;: 176,
                    &quot;name&quot;: &quot;POV&quot;,
                    &quot;slug&quot;: &quot;pov&quot;
                },
                {
                    &quot;id&quot;: 177,
                    &quot;name&quot;: &quot;Female Protagonist&quot;,
                    &quot;slug&quot;: &quot;female-protagonist&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:55.000000Z&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;title&quot;: &quot;Attack on Titan Season 3&quot;,
            &quot;slug&quot;: &quot;attack-on-titan-season-3-99147&quot;,
            &quot;description&quot;: &quot;Eren and his companions in the 104th are assigned to the newly-formed Levi Squad, whose assignment is to keep Eren and Historia safe given Eren&#039;s newly-discovered power and Historia&#039;s knowledge and pedigree. Levi and Erwin have good reason to be concerned, because the priest of the Church that Hanji had hidden away was found tortured to death, making it clear that the Military Police are involved with the cover-up. Things get more harrowing when the MPs make a move on Erwin and the Levi Squad narrowly avoids capture. Eren is also having problems with his Titan transformation, and a deadly killer has been hired to secure Eren and Historia, one Levi knows all too well from his youth.&lt;br&gt;\n&lt;br&gt;\n(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx99147-AiPDD8cwlCfi.jpg&quot;,
            &quot;rating&quot;: &quot;8.50&quot;,
            &quot;year&quot;: 2018,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 12,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 614090,
            &quot;favorites&quot;: 14678,
            &quot;external_id&quot;: &quot;99147&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Kaiju&quot;,
                    &quot;slug&quot;: &quot;kaiju&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Memory Manipulation&quot;,
                    &quot;slug&quot;: &quot;memory-manipulation&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Steampunk&quot;,
                    &quot;slug&quot;: &quot;steampunk&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 29,
                    &quot;name&quot;: &quot;Medieval&quot;,
                    &quot;slug&quot;: &quot;medieval&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 58,
                    &quot;name&quot;: &quot;Fugitive&quot;,
                    &quot;slug&quot;: &quot;fugitive&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 65,
                    &quot;name&quot;: &quot;Yandere&quot;,
                    &quot;slug&quot;: &quot;yandere&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 107,
                    &quot;name&quot;: &quot;Torture&quot;,
                    &quot;slug&quot;: &quot;torture&quot;
                },
                {
                    &quot;id&quot;: 111,
                    &quot;name&quot;: &quot;Matriarchy&quot;,
                    &quot;slug&quot;: &quot;matriarchy&quot;
                },
                {
                    &quot;id&quot;: 115,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 123,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 155,
                    &quot;name&quot;: &quot;Crossdressing&quot;,
                    &quot;slug&quot;: &quot;crossdressing&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:55.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:55.000000Z&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;title&quot;: &quot;My Hero Academia Season 2&quot;,
            &quot;slug&quot;: &quot;my-hero-academia-season-2-21856&quot;,
            &quot;description&quot;: &quot;Taking off right after the last episode of the first season. The school is temporarily closed due to security. When U.A. restarts, it is announced that the highly anticipated School Sports Festival will soon be taking place. All classes: Hero, Support, General and Business will be participating. Tournaments all round will decide who is the top Hero in training.&lt;br&gt;&lt;br&gt;(Source: Anime News Network)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx21856-gutauxhWAwn6.png&quot;,
            &quot;rating&quot;: null,
            &quot;year&quot;: 2017,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 25,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 596747,
            &quot;favorites&quot;: 8666,
            &quot;external_id&quot;: &quot;21856&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 37,
                    &quot;name&quot;: &quot;Adventure&quot;,
                    &quot;slug&quot;: &quot;adventure&quot;
                },
                {
                    &quot;id&quot;: 62,
                    &quot;name&quot;: &quot;Urban Fantasy&quot;,
                    &quot;slug&quot;: &quot;urban-fantasy&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 85,
                    &quot;name&quot;: &quot;Superhero&quot;,
                    &quot;slug&quot;: &quot;superhero&quot;
                },
                {
                    &quot;id&quot;: 87,
                    &quot;name&quot;: &quot;Cultivation&quot;,
                    &quot;slug&quot;: &quot;cultivation&quot;
                },
                {
                    &quot;id&quot;: 109,
                    &quot;name&quot;: &quot;Heterosexual&quot;,
                    &quot;slug&quot;: &quot;heterosexual&quot;
                },
                {
                    &quot;id&quot;: 152,
                    &quot;name&quot;: &quot;Tomboy&quot;,
                    &quot;slug&quot;: &quot;tomboy&quot;
                },
                {
                    &quot;id&quot;: 178,
                    &quot;name&quot;: &quot;Bar&quot;,
                    &quot;slug&quot;: &quot;bar&quot;
                },
                {
                    &quot;id&quot;: 179,
                    &quot;name&quot;: &quot;Cheerleading&quot;,
                    &quot;slug&quot;: &quot;cheerleading&quot;
                },
                {
                    &quot;id&quot;: 180,
                    &quot;name&quot;: &quot;Bisexual&quot;,
                    &quot;slug&quot;: &quot;bisexual&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-02T10:32:01.000000Z&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;title&quot;: &quot;The Promised Neverland&quot;,
            &quot;slug&quot;: &quot;the-promised-neverland-101759&quot;,
            &quot;description&quot;: &quot;Emma, Norman and Ray are the brightest kids at the Grace Field House orphanage. And under the care of the woman they refer to as &ldquo;Mom,&rdquo; all the kids have enjoyed a comfortable life. Good food, clean clothes and the perfect environment to learn&mdash;what more could an orphan ask for? One day, though, Emma and Norman uncover the dark truth of the outside world they are forbidden from seeing.\n&lt;br&gt;&lt;br&gt;\n(Source: Viz Media)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx101759-8UR7r9MNVpz2.jpg&quot;,
            &quot;rating&quot;: &quot;8.30&quot;,
            &quot;year&quot;: 2019,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 12,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 579342,
            &quot;favorites&quot;: 18018,
            &quot;external_id&quot;: &quot;101759&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 21,
                    &quot;name&quot;: &quot;Orphan&quot;,
                    &quot;slug&quot;: &quot;orphan&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 26,
                    &quot;name&quot;: &quot;Coming of Age&quot;,
                    &quot;slug&quot;: &quot;coming-of-age&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 39,
                    &quot;name&quot;: &quot;Demons&quot;,
                    &quot;slug&quot;: &quot;demons&quot;
                },
                {
                    &quot;id&quot;: 52,
                    &quot;name&quot;: &quot;Psychological&quot;,
                    &quot;slug&quot;: &quot;psychological&quot;
                },
                {
                    &quot;id&quot;: 53,
                    &quot;name&quot;: &quot;Thriller&quot;,
                    &quot;slug&quot;: &quot;thriller&quot;
                },
                {
                    &quot;id&quot;: 106,
                    &quot;name&quot;: &quot;Horror&quot;,
                    &quot;slug&quot;: &quot;horror&quot;
                },
                {
                    &quot;id&quot;: 113,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 153,
                    &quot;name&quot;: &quot;Tanned Skin&quot;,
                    &quot;slug&quot;: &quot;tanned-skin&quot;
                },
                {
                    &quot;id&quot;: 166,
                    &quot;name&quot;: &quot;Primarily Child Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-child-cast&quot;
                },
                {
                    &quot;id&quot;: 177,
                    &quot;name&quot;: &quot;Female Protagonist&quot;,
                    &quot;slug&quot;: &quot;female-protagonist&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:56.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:56.000000Z&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;title&quot;: &quot;Attack on Titan Final Season&quot;,
            &quot;slug&quot;: &quot;attack-on-titan-final-season-110277&quot;,
            &quot;description&quot;: &quot;It&rsquo;s been four years since the Scout Regiment reached the shoreline, and the world looks different now. Things are heating up as the fate of the Scout Regiment&mdash;and the people of Paradis&mdash;are determined at last. However, Eren is missing. Will he reappear before age-old tensions between Marleyans and Eldians result in the war of all wars?&lt;br&gt;\n&lt;br&gt;\n(Source: Crunchyroll)&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx110277-sKUNXAsWMNFw.jpg&quot;,
            &quot;rating&quot;: &quot;8.60&quot;,
            &quot;year&quot;: 2020,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 16,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 573174,
            &quot;favorites&quot;: 19938,
            &quot;external_id&quot;: &quot;110277&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 3,
                    &quot;name&quot;: &quot;Fantasy&quot;,
                    &quot;slug&quot;: &quot;fantasy&quot;
                },
                {
                    &quot;id&quot;: 4,
                    &quot;name&quot;: &quot;Mystery&quot;,
                    &quot;slug&quot;: &quot;mystery&quot;
                },
                {
                    &quot;id&quot;: 5,
                    &quot;name&quot;: &quot;Kaiju&quot;,
                    &quot;slug&quot;: &quot;kaiju&quot;
                },
                {
                    &quot;id&quot;: 6,
                    &quot;name&quot;: &quot;Revenge&quot;,
                    &quot;slug&quot;: &quot;revenge&quot;
                },
                {
                    &quot;id&quot;: 7,
                    &quot;name&quot;: &quot;Military&quot;,
                    &quot;slug&quot;: &quot;military&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 13,
                    &quot;name&quot;: &quot;Henshin&quot;,
                    &quot;slug&quot;: &quot;henshin&quot;
                },
                {
                    &quot;id&quot;: 14,
                    &quot;name&quot;: &quot;Gore&quot;,
                    &quot;slug&quot;: &quot;gore&quot;
                },
                {
                    &quot;id&quot;: 15,
                    &quot;name&quot;: &quot;Swordplay&quot;,
                    &quot;slug&quot;: &quot;swordplay&quot;
                },
                {
                    &quot;id&quot;: 16,
                    &quot;name&quot;: &quot;Memory Manipulation&quot;,
                    &quot;slug&quot;: &quot;memory-manipulation&quot;
                },
                {
                    &quot;id&quot;: 17,
                    &quot;name&quot;: &quot;Steampunk&quot;,
                    &quot;slug&quot;: &quot;steampunk&quot;
                },
                {
                    &quot;id&quot;: 18,
                    &quot;name&quot;: &quot;Dystopian&quot;,
                    &quot;slug&quot;: &quot;dystopian&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 22,
                    &quot;name&quot;: &quot;Espionage&quot;,
                    &quot;slug&quot;: &quot;espionage&quot;
                },
                {
                    &quot;id&quot;: 24,
                    &quot;name&quot;: &quot;Kuudere&quot;,
                    &quot;slug&quot;: &quot;kuudere&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 28,
                    &quot;name&quot;: &quot;Survival&quot;,
                    &quot;slug&quot;: &quot;survival&quot;
                },
                {
                    &quot;id&quot;: 30,
                    &quot;name&quot;: &quot;Time Skip&quot;,
                    &quot;slug&quot;: &quot;time-skip&quot;
                },
                {
                    &quot;id&quot;: 32,
                    &quot;name&quot;: &quot;Rural&quot;,
                    &quot;slug&quot;: &quot;rural&quot;
                },
                {
                    &quot;id&quot;: 33,
                    &quot;name&quot;: &quot;CGI&quot;,
                    &quot;slug&quot;: &quot;cgi&quot;
                },
                {
                    &quot;id&quot;: 34,
                    &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-male-cast&quot;
                },
                {
                    &quot;id&quot;: 45,
                    &quot;name&quot;: &quot;Rotoscoping&quot;,
                    &quot;slug&quot;: &quot;rotoscoping&quot;
                },
                {
                    &quot;id&quot;: 46,
                    &quot;name&quot;: &quot;Body Horror&quot;,
                    &quot;slug&quot;: &quot;body-horror&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 59,
                    &quot;name&quot;: &quot;Philosophy&quot;,
                    &quot;slug&quot;: &quot;philosophy&quot;
                },
                {
                    &quot;id&quot;: 60,
                    &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-adult-cast&quot;
                },
                {
                    &quot;id&quot;: 73,
                    &quot;name&quot;: &quot;Dissociative Identities&quot;,
                    &quot;slug&quot;: &quot;dissociative-identities&quot;
                },
                {
                    &quot;id&quot;: 76,
                    &quot;name&quot;: &quot;Shapeshifting&quot;,
                    &quot;slug&quot;: &quot;shapeshifting&quot;
                },
                {
                    &quot;id&quot;: 95,
                    &quot;name&quot;: &quot;Politics&quot;,
                    &quot;slug&quot;: &quot;politics&quot;
                },
                {
                    &quot;id&quot;: 111,
                    &quot;name&quot;: &quot;Matriarchy&quot;,
                    &quot;slug&quot;: &quot;matriarchy&quot;
                },
                {
                    &quot;id&quot;: 115,
                    &quot;name&quot;: &quot;Conspiracy&quot;,
                    &quot;slug&quot;: &quot;conspiracy&quot;
                },
                {
                    &quot;id&quot;: 116,
                    &quot;name&quot;: &quot;War&quot;,
                    &quot;slug&quot;: &quot;war&quot;
                },
                {
                    &quot;id&quot;: 123,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 148,
                    &quot;name&quot;: &quot;Foreign&quot;,
                    &quot;slug&quot;: &quot;foreign&quot;
                },
                {
                    &quot;id&quot;: 181,
                    &quot;name&quot;: &quot;Coastal&quot;,
                    &quot;slug&quot;: &quot;coastal&quot;
                },
                {
                    &quot;id&quot;: 182,
                    &quot;name&quot;: &quot;Terrorism&quot;,
                    &quot;slug&quot;: &quot;terrorism&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T23:00:17.000000Z&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;title&quot;: &quot;Assassination Classroom&quot;,
            &quot;slug&quot;: &quot;assassination-classroom-20755&quot;,
            &quot;description&quot;: &quot;The students of class 3-E have a mission: kill their teacher before graduation. He has already destroyed the moon, and has promised to destroy the Earth if he can not be killed within a year. But how can this class of misfits kill a tentacled monster, capable of reaching Mach 20 speed, who may be the best teacher any of them have ever had?&quot;,
            &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx20755-dWrhs569YGUO.jpg&quot;,
            &quot;rating&quot;: &quot;7.90&quot;,
            &quot;year&quot;: 2015,
            &quot;status&quot;: &quot;finished&quot;,
            &quot;type&quot;: &quot;tv&quot;,
            &quot;number_of_episodes&quot;: 22,
            &quot;aired_from&quot;: null,
            &quot;aired_to&quot;: null,
            &quot;nsfw_flag&quot;: false,
            &quot;popularity&quot;: 566751,
            &quot;favorites&quot;: 16462,
            &quot;external_id&quot;: &quot;20755&quot;,
            &quot;external_source&quot;: &quot;anilist&quot;,
            &quot;tags&quot;: [
                {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Action&quot;,
                    &quot;slug&quot;: &quot;action&quot;
                },
                {
                    &quot;id&quot;: 2,
                    &quot;name&quot;: &quot;Drama&quot;,
                    &quot;slug&quot;: &quot;drama&quot;
                },
                {
                    &quot;id&quot;: 8,
                    &quot;name&quot;: &quot;Tragedy&quot;,
                    &quot;slug&quot;: &quot;tragedy&quot;
                },
                {
                    &quot;id&quot;: 10,
                    &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
                    &quot;slug&quot;: &quot;primarily-teen-cast&quot;
                },
                {
                    &quot;id&quot;: 11,
                    &quot;name&quot;: &quot;Super Power&quot;,
                    &quot;slug&quot;: &quot;super-power&quot;
                },
                {
                    &quot;id&quot;: 12,
                    &quot;name&quot;: &quot;Male Protagonist&quot;,
                    &quot;slug&quot;: &quot;male-protagonist&quot;
                },
                {
                    &quot;id&quot;: 20,
                    &quot;name&quot;: &quot;Ensemble Cast&quot;,
                    &quot;slug&quot;: &quot;ensemble-cast&quot;
                },
                {
                    &quot;id&quot;: 25,
                    &quot;name&quot;: &quot;Shounen&quot;,
                    &quot;slug&quot;: &quot;shounen&quot;
                },
                {
                    &quot;id&quot;: 27,
                    &quot;name&quot;: &quot;Suicide&quot;,
                    &quot;slug&quot;: &quot;suicide&quot;
                },
                {
                    &quot;id&quot;: 38,
                    &quot;name&quot;: &quot;Supernatural&quot;,
                    &quot;slug&quot;: &quot;supernatural&quot;
                },
                {
                    &quot;id&quot;: 54,
                    &quot;name&quot;: &quot;Crime&quot;,
                    &quot;slug&quot;: &quot;crime&quot;
                },
                {
                    &quot;id&quot;: 56,
                    &quot;name&quot;: &quot;Anti-Hero&quot;,
                    &quot;slug&quot;: &quot;anti-hero&quot;
                },
                {
                    &quot;id&quot;: 68,
                    &quot;name&quot;: &quot;Assassins&quot;,
                    &quot;slug&quot;: &quot;assassins&quot;
                },
                {
                    &quot;id&quot;: 77,
                    &quot;name&quot;: &quot;School&quot;,
                    &quot;slug&quot;: &quot;school&quot;
                },
                {
                    &quot;id&quot;: 83,
                    &quot;name&quot;: &quot;Baseball&quot;,
                    &quot;slug&quot;: &quot;baseball&quot;
                },
                {
                    &quot;id&quot;: 84,
                    &quot;name&quot;: &quot;Comedy&quot;,
                    &quot;slug&quot;: &quot;comedy&quot;
                },
                {
                    &quot;id&quot;: 86,
                    &quot;name&quot;: &quot;Bullying&quot;,
                    &quot;slug&quot;: &quot;bullying&quot;
                },
                {
                    &quot;id&quot;: 105,
                    &quot;name&quot;: &quot;Aliens&quot;,
                    &quot;slug&quot;: &quot;aliens&quot;
                },
                {
                    &quot;id&quot;: 113,
                    &quot;name&quot;: &quot;Found Family&quot;,
                    &quot;slug&quot;: &quot;found-family&quot;
                },
                {
                    &quot;id&quot;: 123,
                    &quot;name&quot;: &quot;Guns&quot;,
                    &quot;slug&quot;: &quot;guns&quot;
                },
                {
                    &quot;id&quot;: 129,
                    &quot;name&quot;: &quot;Artificial Intelligence&quot;,
                    &quot;slug&quot;: &quot;artificial-intelligence&quot;
                },
                {
                    &quot;id&quot;: 183,
                    &quot;name&quot;: &quot;Teacher&quot;,
                    &quot;slug&quot;: &quot;teacher&quot;
                },
                {
                    &quot;id&quot;: 184,
                    &quot;name&quot;: &quot;Tentacles&quot;,
                    &quot;slug&quot;: &quot;tentacles&quot;
                },
                {
                    &quot;id&quot;: 185,
                    &quot;name&quot;: &quot;Episodic&quot;,
                    &quot;slug&quot;: &quot;episodic&quot;
                },
                {
                    &quot;id&quot;: 186,
                    &quot;name&quot;: &quot;Femboy&quot;,
                    &quot;slug&quot;: &quot;femboy&quot;
                },
                {
                    &quot;id&quot;: 187,
                    &quot;name&quot;: &quot;School Club&quot;,
                    &quot;slug&quot;: &quot;school-club&quot;
                }
            ],
            &quot;created_at&quot;: &quot;2026-01-01T17:31:57.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:57.000000Z&quot;
        }
    ],
    &quot;links&quot;: {
        &quot;first&quot;: &quot;http://localhost/api/v1/public/anime?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/v1/public/anime?page=1093&quot;,
        &quot;prev&quot;: null,
        &quot;next&quot;: &quot;http://localhost/api/v1/public/anime?page=2&quot;
    },
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 1093,
        &quot;links&quot;: [
            {
                &quot;url&quot;: null,
                &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
                &quot;page&quot;: null,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=1&quot;,
                &quot;label&quot;: &quot;1&quot;,
                &quot;page&quot;: 1,
                &quot;active&quot;: true
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=2&quot;,
                &quot;label&quot;: &quot;2&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=3&quot;,
                &quot;label&quot;: &quot;3&quot;,
                &quot;page&quot;: 3,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=4&quot;,
                &quot;label&quot;: &quot;4&quot;,
                &quot;page&quot;: 4,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=5&quot;,
                &quot;label&quot;: &quot;5&quot;,
                &quot;page&quot;: 5,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=6&quot;,
                &quot;label&quot;: &quot;6&quot;,
                &quot;page&quot;: 6,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=7&quot;,
                &quot;label&quot;: &quot;7&quot;,
                &quot;page&quot;: 7,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=8&quot;,
                &quot;label&quot;: &quot;8&quot;,
                &quot;page&quot;: 8,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=9&quot;,
                &quot;label&quot;: &quot;9&quot;,
                &quot;page&quot;: 9,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=10&quot;,
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
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=1092&quot;,
                &quot;label&quot;: &quot;1092&quot;,
                &quot;page&quot;: 1092,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=1093&quot;,
                &quot;label&quot;: &quot;1093&quot;,
                &quot;page&quot;: 1093,
                &quot;active&quot;: false
            },
            {
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime?page=2&quot;,
                &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
                &quot;page&quot;: 2,
                &quot;active&quot;: false
            }
        ],
        &quot;path&quot;: &quot;http://localhost/api/v1/public/anime&quot;,
        &quot;per_page&quot;: 20,
        &quot;to&quot;: 20,
        &quot;total&quot;: 21843
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
    --get "http://localhost/api/v1/public/episodes/translators" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/episodes/translators"
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
            &quot;translator&quot;: &quot;#студияБУБНЯЖА&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;.black HD&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;1000 и 1 сериал.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;1WINStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;27Gang&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;2D-DUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;2x2&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;2x2 New&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;3NOK&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;3df voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;5-й канал СПб&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;@MUZOBOZ@&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;@PD&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;A-Lakorn&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ABLE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ADStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AEROChannelEkat&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AEROChannelEkat &amp; Melody Note&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AEROChannelEkat &amp; Risha&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AM-Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AMS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AMV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ANI.OMNIA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ANIvoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AOMINE DAIKI&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ARNIMA Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AXLt&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AXLt &amp; Oriko&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Agatha Studdio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AhsataNikaer.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Akame&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Akame.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Akari Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Akikomi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Akimbo Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AlFair Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Aleister&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AlexFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AlisaDirilis&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AlisaPH&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Alisma.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Allecs2010&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AlphaProject&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Alternative Media Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Alternative Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Alusar&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Alvakarp.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amaivon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amateur \&quot;Ibra\&quot;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amazing Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amazing Dubbing.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amazon.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amber&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amedia.online&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amediateka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Amida &amp; Dorama Star&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AnTyDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ancord&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ancord Многоголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Andy&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Andy Green&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBaka &amp; youmiteru&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBar&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBaza&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBaza.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBerry&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBomj&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBoom&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBoom.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBreeze&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBreeze &amp; NoNameDUB Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniBreeze.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniChaos&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniClub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniClub &amp; OBELISK Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniCoin&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniCore&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniCore &amp; DubClub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniCosmic&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniCosmic &amp; GrickVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniCrystal&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDUB &amp; SHIZA Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDUB Online &amp; Ушастая озвучка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDark&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDeshka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDextry Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDorFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDorFilm &amp; AniDub Online&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDoulo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDub Online&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniDub_Online &amp; 3df voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFame&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFast&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFate&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFlames&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFoster&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniFuck&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniGon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniHero&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniHope Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniHoup&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniHouseTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniJoy&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniJoy &amp; Shiroi Kitsune&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniJoy.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniKoe&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLane&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLauba&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLeague.TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLiberty (AniLibria)&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLiberty.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLibria &amp; AnimeSpace&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLibria.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLibria.TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLibria.TV 18+&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLibria.TV Old&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLife&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniLot&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMani.TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMaunt&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMaunt &amp; OpenDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMax&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMax.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMovie&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMur&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniMy.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniNyaTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniOra&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniPLague&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniPlay&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniPlay &amp; Get Smart Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniPlay Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniPlay.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniPower&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniRai&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniRaid / Naoka &amp; Sedrix&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniRigin.TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniRimplee&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniRise&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniRise &amp; Kazoku Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniRise.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniSam&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniSense&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniSquad&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniStar&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniStar &amp; DEEP&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniStar &amp; VK&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniStar Pro&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniStar Многоголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniStarks&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniStart&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniT&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniTime Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniVersal&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniVi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniVoice &amp; VoiceLand&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniVorx Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniZone&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AniZone.TV &amp; Unicorn&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Aniharu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Animakima&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AnimeBest&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AnimeJet&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AnimeLur&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AnimeMovie&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AnimeSpace&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AnimeVost&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Animecore Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Animedia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Animedub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Animegroup&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Animy&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Aniraccoon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Aniu.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Aniverse&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Anna Di&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Anna Di &amp; Shama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Anton Shanteau&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Antuan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Anything Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Anything Group &amp; DubClub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Apple Gold&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Aquanime&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Arasi Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Arasi Project &amp; KIRIANA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AreaDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Arisu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Arlimax&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ArrowHell&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AsiaHouse&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Asian Miracle Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AskaTeam&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Astrum Asia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Asura Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Asura.tv&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AveBrasil&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AveDorama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AveTurk&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AzaVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Azazel&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Azazel &amp; Eshter&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;AziRush Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BBC Spb &amp; LHS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BIG BOSS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BL-Story.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BLACKDiabolik&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BLAZING GROUP&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BLDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BTI Studios&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BaKeneko San&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Back Board Cinema&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BadBajo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BadCatStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Baddest Females&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BaibaKo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BanG Dream! Translations.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BandFilms&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BanderYmka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Bankay Network&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Banyan Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Batafurai Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BeeSound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Beloved&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BeyBeast Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BeyBeast.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Bezdari Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Blackbird Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Bollywood HD&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Bonsai Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BrainDead Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Bravo Records Georgia &amp; Movie Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Brees Club&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;BukeDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Bulbamesh&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CGInfo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CGTN Русский&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CLS Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CP Digital&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CPI Films&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Cactus Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CalliopeHouse&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CapySound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Carrier88&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Carrier88 &amp; Milirina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CelestialDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Charlie.atlost&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Chesterfield&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Chibic_hellgirl&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ChillDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ChomosukeST&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Choson &amp; Chipikish&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;CineLab SoundMix&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ClubFATE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Cmert&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ColdFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Collapse &amp; Kira Ksyll&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Comina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ConeVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Contentica&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Cowabunga Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Crazy Cat studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Crimson Star Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Cringedub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Crunchyroll&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Crunchyroll.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Cuba77&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;D. A. Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;D.I.M.&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;D.l.M.&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DAS Sound Studios&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DAVOICES&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DAVOICES.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DB Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DM Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DM VOICE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DOBROVOICE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DRAGON VOICE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DUB4LIFE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DUBляжники&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DVD Магия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DVd&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dajana&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dajana &amp; Lisek&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dark Papaya&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Datynet &amp; Selena&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DeMon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DeadLine Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DeadSno &amp; den904&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DejzDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Deluka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DemonKitty&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DemonOFmooN&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DexterTV.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dez&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DiO_Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DiabloVoiceOver&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Digga Dubbing&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Digital Force&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dimka Shalankevich&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dimka Shalankevich &amp; Olivia Dei&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Disney Channel&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dizi Denizi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dorama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DoramaBox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DoramaStar&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DoramaWeeks &amp; АрхиAsia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dorama_Star&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DorimЭ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DoubleRec&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dragon Money Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dragon&#039;s Lair&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dragon&#039;s Lair &amp; GrandStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dragon&#039;s Lair.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Drama Love&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dream Cast&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DreamWings&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DreamWings &amp; Sound Lotus&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dreamy Sleep&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DreamyVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DubClub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DubLik.Tv&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;DubyDuby&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Duet F&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Dusado&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;EVA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;East Dream&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ekaterina Popova&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Eladiel&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Eladiel &amp; Absurd&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Eladiel &amp; Jam&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Eladiel &amp; Primary Alex&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Eladiel &amp; Zendos&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Eljim&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Elrom&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;English&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Erlach studios&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;EvilBee&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Evolution Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Evolution Studio &amp; CactusTeam&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Exa&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FAN&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FAN Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FNDP&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FOXWAVE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FRT Sora.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG 24 Hamsters.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG ADALAT.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG ART.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG AS-akura.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Akoya.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Asian Dragons.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Asian Mix.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Asian Shows Subbing Squad.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Azuma Rikimaru.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG BLDUB.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Baddest Females.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Bamboo.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Banana Uyu.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Baron Chen.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Be Mine &amp; FSG Mango.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Be Mine &amp; FSG Reborn &amp; XBS.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Be Mine &amp; XBS.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Be Mine.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG BeMine &amp; Reborn.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG BeMine &amp; Your Dream.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Bears.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Bee With You.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Bees.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Beloved Onnies.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG BetLove.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Big Boss.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Birdman Fansubs.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Black Pearl.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Busy Snail.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG CNGLUK.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Cardinals.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Cats.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG CharmedAsia.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Chenderella.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG CherryLand.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Cheshire Cat &amp; FSG Skylark Maria.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Cheshire Cat.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG China4U.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Crazy Rainbow.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG DESI WORLD PASSION.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG DORAMA WEEKS.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG DREAM COM.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dann.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dark Love Stories.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dark Place.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Demiurges.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Desman TV.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG DiLiLevS.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dilemma.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG DiziMania.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Do4U.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dorama_Star.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Doramadevils.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dorams for you.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Doranime.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dragon Fruit.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dragonfly.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG DramaDora.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dramatic onni.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Dream Serials.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG EisaiSubs.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG FOR EXO&amp;EXO-L.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Fallen.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG FbtS.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Fireflame.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Fizlog.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Fluffy Hedgeh.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Four seasons.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Frog&#039;s home.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Fuckult.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Full Moon.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Gemini.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Good Will.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG HANU FAMILY.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Hanguk.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Hunters.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG INDIA Dark Love Stories ReBorn.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG INDIA SERIALS&trade;Production.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG IRISubs.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Invisible Moon.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG JS Project.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Jade Fox.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Jade Studio.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Just Relax.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG K I S S A.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG K2U.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG KM.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Kassandraa.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG KfreeST.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Kingdom Loli-Pop_Stars.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Krisa-Tyan.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG LD-Asia.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG LOVE STORIES.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG LanHua.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Lana Digzy.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Last Snow.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Lawless Gangster.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Lazy Cats.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Libartlaw.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Libertas.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Light.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Lily.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Little.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG LoVeSeries&amp;Kino.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Lollipop.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG LongShan.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Lotus.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Love Dream.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Love India Production.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Lunas Hunters.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG M.OST.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Magicians.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Mango.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Melissa&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Melissa.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Midnight.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG MontralfiveStudio.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Moonlight Garden.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG N.N. Азия.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG NH.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG NITHYA MENEN.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG NK.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Nasty.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG NeonLight.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Nightmare Muses.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Nunchi.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG ONE GOLDEN KEY.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG OWL FAMILY.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Onlion.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Orimo.mp4.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Otioness.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG PALATA 666.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG PINEAPPLE.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Papillon.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Pathos Loonies.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Phoenixes.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG QMovavi.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG QUEENS.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Queen Rainie Yang.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG RINGU.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Reborn.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Red Paraisol.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Red Tail.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG STAR PLUS TV.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Sanae.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Save our Souls.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Scorpions.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Secret Forest.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG SecretStory.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Shadows.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Skylark Maria.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG SlothSound.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Slyness.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Solo Day.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Solomon.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Space Journey fan-group.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Spring Breeze.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Sub-Unit Zoloto.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG SubQueens.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Sub_Team.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG TG KAST.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG TG Minimvs.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG THAI Dark Love Stories.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG THAI- Lakorn.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG TREASURE.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG TYPICAL INDIAN TV Show.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Tea rose &amp; FSG Lotus.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Tea rose.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Thai Miracle.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Thai marmalade.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG The Art Of Love Asia.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG The Magic of love.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG The Turtles.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG The Witch&#039;s Hut.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Tonyvika&#039;s World.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Twilight.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Umbrella.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Unique.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG VokiDoki.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG WTF.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG White &amp; Black.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG White Cat.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Xvoice Studio.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG YakuSub Studio.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Yoga.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Yokohama Fansubs.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Younet Translate.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Your Dream.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Yupimix.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG di_drama.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG korea.sarang.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG tr&egrave;s bien.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FSG Красный журавль.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Family Club Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FanDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Fanstudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FantomeSub.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FassaD&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FaulyDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Fiendover&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FilmBox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FireDub.Net&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Flame&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FlameVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Flarrow Films&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Flarrow Films &amp; DEEP&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Flarrow Films &amp; Studio Band&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Flavius Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Flowers Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FocusStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Force Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Force Media &amp; Wakanim&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Fox Crime&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Fox Life&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FoxForce&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FrDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Franek Monk&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Freedom Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Freedub Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FrittyXT&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Fronda Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Full Moon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FumoDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;FumoDub.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Futuroom&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;G-Dub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GREEN TEA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GYOZARAMA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Garsu Pasaulis&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Gears Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Geroin_nya&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Get Smart Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Get Smart Group &amp; OpenDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Get Smart Group &amp; SHIZA Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Gezell Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Gingercat&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GoLTFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GoldTeam&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GoodTime Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Gosha-nyan.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GrandStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GrayFox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GreatGroup&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Greb&amp;CGC&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Greb&amp;Creative&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GreenРай Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;GrickVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Grostface&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HDrezka Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HDrezka Studio 18+&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HMP &amp; Вадим Химеров&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HORIZON&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Hamster Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Hard_studiO&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HaronMedia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HaruVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Head Pack Films&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HeatSound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HelgardRay&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HelloMickey Production / HMP&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Helona&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HiWayGrope&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HighHopes&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HikkiDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HikkiDub x ORD&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Honey&amp;Hoseena&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HoneyBee&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Horror Maker&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Hoshi Dreams&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;HotVoice 41&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Huace Croton TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Hunter26&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ICG&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ICG &amp; OnisFilms&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ICHI / BAN &amp; SAKURA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ICY VOICE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;IDEAFILM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;IIITUKATUPKA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;INFINITY Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;INSOMNIA Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ITLM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ITS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;IVI&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Inari Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Indie Dub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Inkwell Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Insane Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Iron Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;IsekaikoVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;J&amp;N Union&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JAM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JWA Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jade Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jamix&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jart Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jaskier&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jayce Eli_Exo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JeFerSon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JeFerSon &amp; KroshkaRu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JetiX&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jimmy J&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jisedai&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JokeR&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JoyStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Julia Prosenuk&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JustDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;JustFunDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Jut.su&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KAIJU SOUND&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KAIJU SOUND &amp; Youkai Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KALGAZM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KANSAI Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KINGang&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KION&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KIRIANA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KKIGHO&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KOMOREBI&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KRAMSAI&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KRT (Kazeaki Ru Team)&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KShow&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KTM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KTM Voice &amp; MikaSalidle&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KZ Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KaenDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kai&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kalabs Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kallaider&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KamiSub.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kashu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kasumi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Katana Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KawaiiTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kazoku Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kazoku Project.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kazuttx&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kazuttx &amp; Raina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kedra&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kedra &amp; Hydra&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KeitAndersenn&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KerobTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kiber Voices&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KidsCo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kiitos&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KimchiTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kin&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KinoGolos&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kira&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KiraiMedia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kitsune Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KitsuneBox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Klio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KoeKak&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kofka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kogarasi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Korean Craze&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KosharaSerials&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KrioDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;KrisTee&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Kukan Drama Russian&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LC Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LDA TEAM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LE-Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LakeFilms&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lali &amp; FISH&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LampStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LanFan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LapkiDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LazDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lebaka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ledikion&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Leff Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lemiankona&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lemon+&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Leviafilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LiLu group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Liberal Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Licoforice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Licoforice &amp; Shiroi Kitsune&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lifecycle (укр)&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Light Breeze&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Light Family.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Light Fox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LightFamily&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LineFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lion&#039;s Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LisanStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lisek&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Little cloud&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lizard Cinema&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LordAlukart &amp; Klaksa&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LostFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;LostLife Studio.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lotus Group &amp; Yukio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Lucky Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Luna Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Luna Studio.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MC Entertainment&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MCA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MCA-lab&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MCShamaN&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MDA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MILA DIZI.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MIN-Dub Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MKStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ML.Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MOPO888&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MVO Восторг&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MYS media team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Mai&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Malfurik&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Mamoru02&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Marclail&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MarfeyaVoice studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Marie &amp; Veler&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Marta&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Master Zen&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MaxDamage&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Maxzer &amp; Tinda&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MayLi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MedusaSub.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Melis&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MelissaTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MiSu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Midori Noizu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MifFan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MifSnaiper&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MikaSalidle&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MikaSalidle &amp; OFFICIAL KZ_GMM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Milirina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Miori&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Miori &amp; Rain77&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MiraiDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MisCast&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MixFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Molodoy&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Mona Lisa&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Montana&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MoonLord &amp; Myako&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MoonWalkers&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Moonlight Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;More Enemies&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Moscow City Animegroup&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MovieDalen&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Moygolos&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Mr.Jack&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Muroi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Mustadio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Mutisia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;My Thai Сlub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;MyAska&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Myau myau&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NAG&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NEON Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NHK&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NIGHT VOICE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NIKITOS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;N_O_R_A&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;N_O_R_A.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NaKolenke&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Naikō.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NaimanFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Naruto Silver&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Naruto-Base&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NarutoFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Nazel &amp; Freya&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NegauShi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NekoVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Neon Films&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NetLab Anima Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Netflix&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Netflix.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;New Horizons Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;New Land Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;New Records&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NewComers&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NewDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NewStation&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NewStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NextVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Nickelodeon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NikolasGrande&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NoMi Dub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NoNameDUB Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Noplex Team.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Nosferatu13fd&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;NothinG&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Nova&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Novamedia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Nuriko &amp; Absurd&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OBELISK Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ODALETYDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OPRUS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OPRUS.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ORA-ORA Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OSLIKt&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;O_ART&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Octopus&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Okko&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OksLuna&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Omega&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Omori&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Omori.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Omskbird records&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OnAir&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OnWave&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Onibaku&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Onigiri&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OnisFilms&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OnlyDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OnlyShiny&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OpenDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Oppa-a-a&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Oppa-a-a.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;OriGami&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Oxana Dab&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ozz.tv&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;PCB Translate&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;PHOENIX DUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;PRIdurki Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;PantsuVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Panzu.info&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Paradox &amp; Omskbird records&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Paragraph Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Parovoz Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;PashaUp aka Павел Морозов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Pazi Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Pazl Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Persona99&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Persona99 &amp; MaxDamage&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Persona99 &amp; Molodoy&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Persona99 &amp; Ryc99&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Persona99 &amp; Yukio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Phoenixes&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;PiratVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Plan B&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Podval Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Pokefans Community.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Pride Production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;PureAnime&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Pus&#039;ki production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Q-Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Quadro Records&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Qzfee&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;R5&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RAIM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RBCDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;REDNIK&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RG Full Moon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RG Genshiken&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RG.Paravozik&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RGB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RIOK FILMS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RJ24 &amp; Юся&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RONIDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RUSCICO&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RadiantVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Raffi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Raikiri&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Rain Death&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RainDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ranmaru&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RavenFamily&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RavenStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Re: Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ReVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RealFake&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Reanimedia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Reanimedia.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RecentFilms&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Red Head Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Red Head Sound &amp; Studio Band&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Red Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Red Tail&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Red Thread&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RedDiamond Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Renascendi Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Renegade Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Retto&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Rezan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Rhinestone&#039;s&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RiN&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Riddle Space&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RikuSempai.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Rise&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Risens Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Robiris&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RokuDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RoomDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RuDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Rus-Азия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RusFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RussianGuy27&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Rvision&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;RyukenDub Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;R&eacute;citant&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SAYGEX&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SD Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SDI Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SEIU CLUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SEKAI PROJECT&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SENU Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SENU Project &amp; youmiteru&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SEOUL BAY&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SHIZA Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SHIZA Project &amp; youmiteru&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SHIZA Project 18+&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SHIZA Project.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SLI dabbers group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SMGO Records&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SMX Studios&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SMX Studios.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SPAWN&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;STAR-TREK&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;STEPonee&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;STOP-KRAN&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;STUDIO RISE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SUGOI SOUND&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sad Kit&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sad_kit &amp; Milirina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SagiTtarius&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Saint Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sakura Soul&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sakurina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Samurai7&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SamuraiDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;San-tyan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Satkur&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Saturn Union&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SeM &amp; K&ordm;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sedorelli&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Selena International&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sephiroth&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Serg Tex&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sergei Vasya&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sergei Vasya &amp; Mamzelka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sergej80&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SerosFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SesDizi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shachiburi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shachiburi &amp; Persona99&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shadow Dub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ShadowVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shaman&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shangu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shift.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shikoku Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shinaji Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ShinkaDan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shinobi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shinsengumi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shiroi Kitsune&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shliapa&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Shoker&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Showjet&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Siava62&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Silent Empire&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SillyCat Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Silver AniAge&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Simargl9&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Simple Dorama Style&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Simplicius&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sketch&trade;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Skiminok и Akikomi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SkinkaDan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Slavnus Spacedust&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SlimeTime&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SlothSound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SmutyDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SoftBox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sonata&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sonata &amp; Ray&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sony Turbo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Soul Loony&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SoulPro&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SoulStudio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Soullab.&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sound Film&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sound Lotus&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sound Lotus &amp; Shama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sound-Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sound-Group &amp; BTT-Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SovetRomantica&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SovetRomantica.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Spike&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Spring Breeze&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;StarBand&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;StarFlame Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Starlight Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SteelDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Storyfey&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Straight.Pro&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;StreamSound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Strekoza Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Studii Net&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Studio Band&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Studio Band &amp; DEEP&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Studio Band &amp; Wakanim&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Studio Band Junior&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Studio Chubu&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Studio Rizava&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Stудия Wik&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SubVost.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;SunDub &amp; VOX-S&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sunshine Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Superbit&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Suzaku&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Sweet Voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Swimming Cat&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TAKEOVER Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TANIY&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TF-AniGroup&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TIKCINE TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TINKEIT&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TPG Dorama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TV1000&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TVShows&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TakoSubs.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TapTapDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Team Moon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;The Answer Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;The Cult Of Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;The Kitchen Russia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;The Voice Company&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TheDoctor Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TimaMan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TimaMan &amp; Milirina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Timber Maniacs.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Tina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Tina &amp; OziRIST&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Tinda&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Tony-182&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Tonyko&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Totorus&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Train Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Treph&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TriadaDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Trina_D&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Trina_D &amp; Rizz_Fisher&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Trinity&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Trinity Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;True Dubbing Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;TrueDB.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Tsunami voice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Turbo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Turkish Oasis&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Twix&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Tycoon&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;UJ Team&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;UMP/GFS&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;UNDERGROUND VOICE&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ultradox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Umlaut&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Unicom&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Unicorn&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Unravel&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VERSO&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VF-Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VHSник&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VILL&Aacute;RION&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VK&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VO-production&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VOICE PROJECT STUDIO&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VOICEDUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VOLKOFRENIA&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VOX-S&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Valeri&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Valkrist&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Valkrist &amp; Keneretta&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VashMax2&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Vendetta (Vina &amp; Псих)&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Victory-Films&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Videofilm Int.&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Viju&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Vilfa Films&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Vina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Vinestra&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ViruseProject&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Visanti Vasaer&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Voice Group&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VoiceHub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VoiceLand&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VoiceLand &amp; OtakuDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VoiceLand.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VoiceWay&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Voize&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;VokiDoki&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Volk&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Vox Records&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Vulpes Vulpes&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;WafflesProject&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Wakanim&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Wakanim.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;WeTV Russian&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;WeTV Russian.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;West Video&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;WestFilm&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;WiaDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;WinMedia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Winvix&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;WoW.DUB&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;XDUB Dorama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;XDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;XL Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Xala.Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Xelenum&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Xelenum &amp; Ruri&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Xvoice Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;YARilo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Yamete&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Yamoturo Sound&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;YapiDub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;YoYo ТВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Yoga&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;YouNet Translate&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Youkai Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Your Dream&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Yudziro&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Yuki.Stereo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Yumeko | DojXo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Yupi&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ZEE TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zane&#039;s Project&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zendos&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zendos &amp; Nomia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ZeroVoice&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zetflix&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zetsubou&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ZicAsakuro&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zick Ryder&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zodik&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Zone Vision Studio&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;absurd95&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;aleksei80&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;animereactor&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;datynet&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;datynet &amp; Galina Vasyukova&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;datynet &amp; Yuka_chan&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;den904&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;dorama_mylive&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;iDimo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;iTunes&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ibadub&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ilia_smart_&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;irilia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;kDiana&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;knars&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;laroza&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;liosaa&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;lord666&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;loster01&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;loster01 &amp; Emeri&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;lunar-vox&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;metalrus&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;mi24&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;micola777&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;micola777 &amp; Murder Princess&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;neko64&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;oDaletY&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;olegorigin&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;profesor1975&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ralf124c41+&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;rj24&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;shaltai79&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;valir55&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;viktor_2838&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;youmiteru&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;zamez&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;А. Воронов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Автоперевод&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Автоперевод.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Агата Филин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Адриан &amp; Karipso&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Азалии&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Акира&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Акцент&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Алекс Килька&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Алексеев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Алексей Паук&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Алёна Эм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Алёна Эм.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Амир&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ананас&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Анастасия Гайдаржи&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Анатолий Ашмарин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Андрей Питерский&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;АнимеЯчейка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;АрхиAsia&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Багичев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Бакеев Адиль&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Баритон&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Белов Вадим&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Береговых&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Благословенный Небожитель&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Боллектив Media&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Бунраку&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Буханка.TV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;В ПОДПОЛЬЕ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ВГТРК&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ВПодполье&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Важный Гусь&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Вартан Дохалов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Велес&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ВидеоПродакшн&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Видеосервис&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Видеофильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Визгунов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Вистерия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Витаминный холод&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Володарский&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Lem0nka&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Milirina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Misa&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Sandairina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Tess&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Wenlana&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Лана&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ворон &amp; Элейн&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Воротилин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Всё сведено&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Высокая Азия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Гаврилов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Гланц&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Гланц &amp; Королева&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Горчаков&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Гранкин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Григорий Михайлов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Гумрал&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ДИК - Правильная озвучка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ДТВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Данилов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дар Судьбы&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дарий&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дасевич&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Двухголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ДиоНиК&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дмитриева Светлана&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дольский&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Домик Сумасшедших Дабберов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Домик Хикки&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дораманутая / W&sup3;: voices&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дорамчик и я&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дохалов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Другое кино&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дублированный&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Дубляжная&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Евгения Лурье&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Екатеринбург Арт&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Есарев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Живов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Заговорщики&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ЗвукоРубка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Иванов Михаил&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Индийское кино&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Индия ТВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Инис&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Инь Ян Войс&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ирина Котова&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;КИНЕКО&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;КОМНАТА ДИДИ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;КОМНАТА ДИДИ (Альтернативная)&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Казаков Александр&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Карамелька&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кармен Видео&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Карповский&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Карусель&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Карцев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кассумия.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кашкин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;КиноПоиск HD&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кинолюкс&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Киномания&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кинопремьера&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Киностудия им. Горького&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Киноужас&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кинсэй&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кипарис&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кирдин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кириллица&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кладбище топовых релизов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Клан теней&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Колобок&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Колобок &amp; XDUB Dorama&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Команда Cats&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Королев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Корсаков А.&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Котов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кошка БесТиЯ &amp; codevip&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кошка Бестия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кошкин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кравец&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Красота и сказка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кубик в Кубе&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кузнецов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Культура&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Кюнефе&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Лайко&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Лапшин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ледяное пекло&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Лексикон&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ленфильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Либергал&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Листочек&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Лыдин Алексей&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Люб. Двухголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Люб. Многоголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Люб. Одноголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;МИР&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Макс Летов &amp; ShiYori&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Манипулятор.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Марафон&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Матч ТВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мельница&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Менталитет&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мика Бондарик&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Милвус&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мир дорам&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мистас&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мистас &amp; NesTea&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Михалев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Многоголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мобильное телевидение&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мост-Видео&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мосфильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мосфильм-Мастер&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мудров&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мужской войсовер&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Мыльные оперы Турции&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;НИКО&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;НСТ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;НТВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Назаров&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Настён Грэй&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Не требуется&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Невафильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Невинный Кружок&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Немахов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Немое кино (Музыка)&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Новый Диск&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Новый канал&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Нота&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ОВН&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ОВН.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ОРТ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ОТВ HD&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Одноголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Озвучка 404&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Озвучка Миры&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Оканэ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Оканэ.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Омега&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Омикрон&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Оригинальная&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Останкино&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ПВА ШОУ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Паноптикум&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Парадиз&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Пекарня &laquo;Папин хлеб&raquo;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Переулок Переводмана&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Пирамида&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Пифагор&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ПичиTV&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Плюшевая Озвучка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Позитив&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Послесмешье&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Премьер Видео Фильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Прокс&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Проф. Двухголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Проф. Многоголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Проф. Одноголосый&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;РТР / Россия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Рабочая партия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;РенТВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ринтарю&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ричард Фенрир&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ричард2323&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Рост&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;РуАниме / DEEP&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;РуАниме / DEEP.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Русский дубляж&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Русский репортаж&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Рутилов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Рябов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;СВ Студия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;СТС&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сабина Гардашова&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Санаев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сафронов Иван&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сербин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сергей Царёв&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сибирский&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Симбад&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Симбад &amp; Vina&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Синема УС&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сладкая парочка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Смирнов Александр&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сонотек&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сонькин&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Союз Видео&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Стартрек&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Стефан&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Столяров Алекс&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Странные миры&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студийный Огурчик&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия \&quot;ПИП\&quot;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия LKM&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия LKM.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия &laquo;Закадровая&raquo;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия &laquo;Титан-рекордс&raquo;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия Камертон&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия Константина Исаева&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия Пиратского Дубляжа&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Студия ТВ+&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Субтитры&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сыендук&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Сэм Квинта&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Т.О Друзей&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТВ3&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТВ6&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТНТ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТО \&quot;Хлебные лапки\&quot;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТО Bamboo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТО Bamboo.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТО StudioSeyo&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТО Дия&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТО Дубляжная&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Тайм Медиа Групп&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Творческая студия МИР&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Тимофеев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Толмачев Дмитрий&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Толстобров&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Тоникс Медиа&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Трамвай-фильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Трина Дубовицкая&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ТуЧа&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Узы Гименея&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Украинский&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ульпаней Эльром&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ушастая озвучка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Ушастая озвучка.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Ёжик В-Тумане.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Азалии.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Альянс&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Альянс.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Анна Окидзукэ.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ АрхиAsia.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ БоЧжань.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Бутерброд с солнцем.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Дораманутая / W&sup3;: voices.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Дорамный мир.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Дорамотерапия.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Дракон Мушу.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Дуэт Ларчик.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Ехидные дорамщицы.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Зеленый нефрит.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Зелень.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Зиппер / Zipper.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Ивушка.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Красота и сказка.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ ЛиД.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ ЛитПеревод.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Луна.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Мания.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Нефрит.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Оранжевый фонарик.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Орион.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Сам себе переводчик.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Сладкая вата.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ ТаЛи.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Твоя Шицзе.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Тигрята на подсолнухе.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Томато.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ ТриНити.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ У ЛУН.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ ФантAsia.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Цай Шэн.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Шандерия.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ФСГ Яойный Яой.Subtitles&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Фан-Фан Дорам&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Феникс-клуб&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Формат АВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Фортуна-Фильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ХЗ Лол&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ХЗ Лол &amp; Аноним&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Харука&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Хейли23&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Химеров Вадим&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Хихикающий доктор&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Хмурая Тучка &amp; Волжская Чайка&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Хоррор Мейкер&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Храм Дорам ТВ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Храм тысячи струн&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Чадов&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Чемоданов Продакшн&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Чип и Дейл&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ШУМНЫЕ СОСЕДИ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Шантик&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Эй Би Видео&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Элегия фильм&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Юджин Найт&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Юки&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Юки Нацуи&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Юпикс&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Яковлев&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;Яроцкий&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;заКАДРЫ&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;студия \&quot;Позитив\&quot;&quot;,
            &quot;translation_type&quot;: &quot;voice&quot;
        },
        {
            &quot;translator&quot;: &quot;ёSub.Subtitles&quot;,
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
    --get "http://localhost/api/v1/public/episodes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/episodes"
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
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 1,
            &quot;season_number&quot;: 0,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613600/3ad66e72dab862fa1e3d06416bc8eac6/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 1,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613601/3ad66e72dab862fa1e3d06416bc8eac6/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 2,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613602/a5437999aae6fb1c3603f8cf9ed9cad8/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 3,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613603/ae58fffc57cd931c40ff95c056910735/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 4,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613604/abd3afbf967807b69bda60874ef669a0/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 5,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613605/6ad06b0199a7dfb4c9b59b7a91ce074c/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 6,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613606/e9c460ffd86e5d8d4ba41461f0307d73/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 7,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613607/d3aaaca3e69173effe054f436d1a755d/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 8,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613608/1b4c822e863e8692aa86f3f739a5d695/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 9,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613609/63f78c8fdf7e916af16b14f40db25443/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 10,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613610/ae6e0d4ecffa29dd9ab558eb38a8d3e7/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 11,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613611/37b613a7092d4ed6645f9f4211b9e7ea/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 13,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 12,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613612/707f6cc231f9370b9334d642b328a032/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 13,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613613/59dd67fa50d72689b8703937e06b0305/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 14,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613614/acf3f3541dc44c69bb5dc77652025ebb/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 15,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613615/b47a6eb0b058078fd7b0729f85ee80d3/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 16,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613616/d937ba737837d8f5c13bfa27614b5a20/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 17,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613617/21dd7177e4ce9eaac7d575efe4ee796f/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 18,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613618/3764ff88d8c0cd59e924b65f2272be5b/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;anime_id&quot;: 1,
            &quot;episode_number&quot;: 19,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/613619/48f5a678649e848108c7fca03477c697/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Animedia&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
        }
    ],
    &quot;first_page_url&quot;: &quot;http://localhost/api/v1/public/episodes?page=1&quot;,
    &quot;from&quot;: 1,
    &quot;last_page&quot;: 56990,
    &quot;last_page_url&quot;: &quot;http://localhost/api/v1/public/episodes?page=56990&quot;,
    &quot;links&quot;: [
        {
            &quot;url&quot;: null,
            &quot;label&quot;: &quot;&amp;laquo; Previous&quot;,
            &quot;page&quot;: null,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=1&quot;,
            &quot;label&quot;: &quot;1&quot;,
            &quot;page&quot;: 1,
            &quot;active&quot;: true
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=2&quot;,
            &quot;label&quot;: &quot;2&quot;,
            &quot;page&quot;: 2,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=3&quot;,
            &quot;label&quot;: &quot;3&quot;,
            &quot;page&quot;: 3,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=4&quot;,
            &quot;label&quot;: &quot;4&quot;,
            &quot;page&quot;: 4,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=5&quot;,
            &quot;label&quot;: &quot;5&quot;,
            &quot;page&quot;: 5,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=6&quot;,
            &quot;label&quot;: &quot;6&quot;,
            &quot;page&quot;: 6,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=7&quot;,
            &quot;label&quot;: &quot;7&quot;,
            &quot;page&quot;: 7,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=8&quot;,
            &quot;label&quot;: &quot;8&quot;,
            &quot;page&quot;: 8,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=9&quot;,
            &quot;label&quot;: &quot;9&quot;,
            &quot;page&quot;: 9,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=10&quot;,
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
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=56989&quot;,
            &quot;label&quot;: &quot;56989&quot;,
            &quot;page&quot;: 56989,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=56990&quot;,
            &quot;label&quot;: &quot;56990&quot;,
            &quot;page&quot;: 56990,
            &quot;active&quot;: false
        },
        {
            &quot;url&quot;: &quot;http://localhost/api/v1/public/episodes?page=2&quot;,
            &quot;label&quot;: &quot;Next &amp;raquo;&quot;,
            &quot;page&quot;: 2,
            &quot;active&quot;: false
        }
    ],
    &quot;next_page_url&quot;: &quot;http://localhost/api/v1/public/episodes?page=2&quot;,
    &quot;path&quot;: &quot;http://localhost/api/v1/public/episodes&quot;,
    &quot;per_page&quot;: 20,
    &quot;prev_page_url&quot;: null,
    &quot;to&quot;: 20,
    &quot;total&quot;: 1139788
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
    --get "http://localhost/api/v1/public/tags" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/tags"
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
            &quot;id&quot;: 349,
            &quot;name&quot;: &quot;4-koma&quot;,
            &quot;slug&quot;: &quot;4-koma&quot;
        },
        {
            &quot;id&quot;: 311,
            &quot;name&quot;: &quot;Achromatic&quot;,
            &quot;slug&quot;: &quot;achromatic&quot;
        },
        {
            &quot;id&quot;: 69,
            &quot;name&quot;: &quot;Achronological Order&quot;,
            &quot;slug&quot;: &quot;achronological-order&quot;
        },
        {
            &quot;id&quot;: 352,
            &quot;name&quot;: &quot;Acrobatics&quot;,
            &quot;slug&quot;: &quot;acrobatics&quot;
        },
        {
            &quot;id&quot;: 66,
            &quot;name&quot;: &quot;Acting&quot;,
            &quot;slug&quot;: &quot;acting&quot;
        },
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Action&quot;,
            &quot;slug&quot;: &quot;action&quot;
        },
        {
            &quot;id&quot;: 35,
            &quot;name&quot;: &quot;Adoption&quot;,
            &quot;slug&quot;: &quot;adoption&quot;
        },
        {
            &quot;id&quot;: 37,
            &quot;name&quot;: &quot;Adventure&quot;,
            &quot;slug&quot;: &quot;adventure&quot;
        },
        {
            &quot;id&quot;: 408,
            &quot;name&quot;: &quot;Advertisement&quot;,
            &quot;slug&quot;: &quot;advertisement&quot;
        },
        {
            &quot;id&quot;: 236,
            &quot;name&quot;: &quot;Afterlife&quot;,
            &quot;slug&quot;: &quot;afterlife&quot;
        },
        {
            &quot;id&quot;: 213,
            &quot;name&quot;: &quot;Age Gap&quot;,
            &quot;slug&quot;: &quot;age-gap&quot;
        },
        {
            &quot;id&quot;: 195,
            &quot;name&quot;: &quot;Age Regression&quot;,
            &quot;slug&quot;: &quot;age-regression&quot;
        },
        {
            &quot;id&quot;: 278,
            &quot;name&quot;: &quot;Agender&quot;,
            &quot;slug&quot;: &quot;agender&quot;
        },
        {
            &quot;id&quot;: 247,
            &quot;name&quot;: &quot;Agriculture&quot;,
            &quot;slug&quot;: &quot;agriculture&quot;
        },
        {
            &quot;id&quot;: 365,
            &quot;name&quot;: &quot;Ahegao&quot;,
            &quot;slug&quot;: &quot;ahegao&quot;
        },
        {
            &quot;id&quot;: 379,
            &quot;name&quot;: &quot;Airsoft&quot;,
            &quot;slug&quot;: &quot;airsoft&quot;
        },
        {
            &quot;id&quot;: 147,
            &quot;name&quot;: &quot;Alchemy&quot;,
            &quot;slug&quot;: &quot;alchemy&quot;
        },
        {
            &quot;id&quot;: 105,
            &quot;name&quot;: &quot;Aliens&quot;,
            &quot;slug&quot;: &quot;aliens&quot;
        },
        {
            &quot;id&quot;: 171,
            &quot;name&quot;: &quot;Alternate Universe&quot;,
            &quot;slug&quot;: &quot;alternate-universe&quot;
        },
        {
            &quot;id&quot;: 392,
            &quot;name&quot;: &quot;American Football&quot;,
            &quot;slug&quot;: &quot;american-football&quot;
        },
        {
            &quot;id&quot;: 31,
            &quot;name&quot;: &quot;Amnesia&quot;,
            &quot;slug&quot;: &quot;amnesia&quot;
        },
        {
            &quot;id&quot;: 262,
            &quot;name&quot;: &quot;Amputation&quot;,
            &quot;slug&quot;: &quot;amputation&quot;
        },
        {
            &quot;id&quot;: 126,
            &quot;name&quot;: &quot;Anachronism&quot;,
            &quot;slug&quot;: &quot;anachronism&quot;
        },
        {
            &quot;id&quot;: 364,
            &quot;name&quot;: &quot;Anal Sex&quot;,
            &quot;slug&quot;: &quot;anal-sex&quot;
        },
        {
            &quot;id&quot;: 194,
            &quot;name&quot;: &quot;Ancient China&quot;,
            &quot;slug&quot;: &quot;ancient-china&quot;
        },
        {
            &quot;id&quot;: 144,
            &quot;name&quot;: &quot;Angels&quot;,
            &quot;slug&quot;: &quot;angels&quot;
        },
        {
            &quot;id&quot;: 50,
            &quot;name&quot;: &quot;Animals&quot;,
            &quot;slug&quot;: &quot;animals&quot;
        },
        {
            &quot;id&quot;: 385,
            &quot;name&quot;: &quot;Anthology&quot;,
            &quot;slug&quot;: &quot;anthology&quot;
        },
        {
            &quot;id&quot;: 78,
            &quot;name&quot;: &quot;Anthropomorphism&quot;,
            &quot;slug&quot;: &quot;anthropomorphism&quot;
        },
        {
            &quot;id&quot;: 56,
            &quot;name&quot;: &quot;Anti-Hero&quot;,
            &quot;slug&quot;: &quot;anti-hero&quot;
        },
        {
            &quot;id&quot;: 234,
            &quot;name&quot;: &quot;Archery&quot;,
            &quot;slug&quot;: &quot;archery&quot;
        },
        {
            &quot;id&quot;: 424,
            &quot;name&quot;: &quot;Armpits&quot;,
            &quot;slug&quot;: &quot;armpits&quot;
        },
        {
            &quot;id&quot;: 134,
            &quot;name&quot;: &quot;Aromantic&quot;,
            &quot;slug&quot;: &quot;aromantic&quot;
        },
        {
            &quot;id&quot;: 135,
            &quot;name&quot;: &quot;Arranged Marriage&quot;,
            &quot;slug&quot;: &quot;arranged-marriage&quot;
        },
        {
            &quot;id&quot;: 129,
            &quot;name&quot;: &quot;Artificial Intelligence&quot;,
            &quot;slug&quot;: &quot;artificial-intelligence&quot;
        },
        {
            &quot;id&quot;: 70,
            &quot;name&quot;: &quot;Asexual&quot;,
            &quot;slug&quot;: &quot;asexual&quot;
        },
        {
            &quot;id&quot;: 416,
            &quot;name&quot;: &quot;Ashikoki&quot;,
            &quot;slug&quot;: &quot;ashikoki&quot;
        },
        {
            &quot;id&quot;: 373,
            &quot;name&quot;: &quot;Asphyxiation&quot;,
            &quot;slug&quot;: &quot;asphyxiation&quot;
        },
        {
            &quot;id&quot;: 68,
            &quot;name&quot;: &quot;Assassins&quot;,
            &quot;slug&quot;: &quot;assassins&quot;
        },
        {
            &quot;id&quot;: 299,
            &quot;name&quot;: &quot;Astronomy&quot;,
            &quot;slug&quot;: &quot;astronomy&quot;
        },
        {
            &quot;id&quot;: 275,
            &quot;name&quot;: &quot;Athletics&quot;,
            &quot;slug&quot;: &quot;athletics&quot;
        },
        {
            &quot;id&quot;: 304,
            &quot;name&quot;: &quot;Augmented Reality&quot;,
            &quot;slug&quot;: &quot;augmented-reality&quot;
        },
        {
            &quot;id&quot;: 343,
            &quot;name&quot;: &quot;Autobiographical&quot;,
            &quot;slug&quot;: &quot;autobiographical&quot;
        },
        {
            &quot;id&quot;: 248,
            &quot;name&quot;: &quot;Aviation&quot;,
            &quot;slug&quot;: &quot;aviation&quot;
        },
        {
            &quot;id&quot;: 356,
            &quot;name&quot;: &quot;Badminton&quot;,
            &quot;slug&quot;: &quot;badminton&quot;
        },
        {
            &quot;id&quot;: 400,
            &quot;name&quot;: &quot;Ballet&quot;,
            &quot;slug&quot;: &quot;ballet&quot;
        },
        {
            &quot;id&quot;: 232,
            &quot;name&quot;: &quot;Band&quot;,
            &quot;slug&quot;: &quot;band&quot;
        },
        {
            &quot;id&quot;: 178,
            &quot;name&quot;: &quot;Bar&quot;,
            &quot;slug&quot;: &quot;bar&quot;
        },
        {
            &quot;id&quot;: 83,
            &quot;name&quot;: &quot;Baseball&quot;,
            &quot;slug&quot;: &quot;baseball&quot;
        },
        {
            &quot;id&quot;: 326,
            &quot;name&quot;: &quot;Basketball&quot;,
            &quot;slug&quot;: &quot;basketball&quot;
        },
        {
            &quot;id&quot;: 133,
            &quot;name&quot;: &quot;Battle Royale&quot;,
            &quot;slug&quot;: &quot;battle-royale&quot;
        },
        {
            &quot;id&quot;: 383,
            &quot;name&quot;: &quot;Biographical&quot;,
            &quot;slug&quot;: &quot;biographical&quot;
        },
        {
            &quot;id&quot;: 180,
            &quot;name&quot;: &quot;Bisexual&quot;,
            &quot;slug&quot;: &quot;bisexual&quot;
        },
        {
            &quot;id&quot;: 342,
            &quot;name&quot;: &quot;Blackmail&quot;,
            &quot;slug&quot;: &quot;blackmail&quot;
        },
        {
            &quot;id&quot;: 99,
            &quot;name&quot;: &quot;Board Game&quot;,
            &quot;slug&quot;: &quot;board-game&quot;
        },
        {
            &quot;id&quot;: 82,
            &quot;name&quot;: &quot;Boarding School&quot;,
            &quot;slug&quot;: &quot;boarding-school&quot;
        },
        {
            &quot;id&quot;: 46,
            &quot;name&quot;: &quot;Body Horror&quot;,
            &quot;slug&quot;: &quot;body-horror&quot;
        },
        {
            &quot;id&quot;: 354,
            &quot;name&quot;: &quot;Body Image&quot;,
            &quot;slug&quot;: &quot;body-image&quot;
        },
        {
            &quot;id&quot;: 170,
            &quot;name&quot;: &quot;Body Swapping&quot;,
            &quot;slug&quot;: &quot;body-swapping&quot;
        },
        {
            &quot;id&quot;: 322,
            &quot;name&quot;: &quot;Bondage&quot;,
            &quot;slug&quot;: &quot;bondage&quot;
        },
        {
            &quot;id&quot;: 372,
            &quot;name&quot;: &quot;Boobjob&quot;,
            &quot;slug&quot;: &quot;boobjob&quot;
        },
        {
            &quot;id&quot;: 260,
            &quot;name&quot;: &quot;Bowling&quot;,
            &quot;slug&quot;: &quot;bowling&quot;
        },
        {
            &quot;id&quot;: 327,
            &quot;name&quot;: &quot;Boxing&quot;,
            &quot;slug&quot;: &quot;boxing&quot;
        },
        {
            &quot;id&quot;: 256,
            &quot;name&quot;: &quot;Boys&#039; Love&quot;,
            &quot;slug&quot;: &quot;boys-love&quot;
        },
        {
            &quot;id&quot;: 86,
            &quot;name&quot;: &quot;Bullying&quot;,
            &quot;slug&quot;: &quot;bullying&quot;
        },
        {
            &quot;id&quot;: 201,
            &quot;name&quot;: &quot;Butler&quot;,
            &quot;slug&quot;: &quot;butler&quot;
        },
        {
            &quot;id&quot;: 33,
            &quot;name&quot;: &quot;CGI&quot;,
            &quot;slug&quot;: &quot;cgi&quot;
        },
        {
            &quot;id&quot;: 324,
            &quot;name&quot;: &quot;Calligraphy&quot;,
            &quot;slug&quot;: &quot;calligraphy&quot;
        },
        {
            &quot;id&quot;: 336,
            &quot;name&quot;: &quot;Camping&quot;,
            &quot;slug&quot;: &quot;camping&quot;
        },
        {
            &quot;id&quot;: 23,
            &quot;name&quot;: &quot;Cannibalism&quot;,
            &quot;slug&quot;: &quot;cannibalism&quot;
        },
        {
            &quot;id&quot;: 94,
            &quot;name&quot;: &quot;Card Battle&quot;,
            &quot;slug&quot;: &quot;card-battle&quot;
        },
        {
            &quot;id&quot;: 310,
            &quot;name&quot;: &quot;Cars&quot;,
            &quot;slug&quot;: &quot;cars&quot;
        },
        {
            &quot;id&quot;: 251,
            &quot;name&quot;: &quot;Centaur&quot;,
            &quot;slug&quot;: &quot;centaur&quot;
        },
        {
            &quot;id&quot;: 423,
            &quot;name&quot;: &quot;Cervix Penetration&quot;,
            &quot;slug&quot;: &quot;cervix-penetration&quot;
        },
        {
            &quot;id&quot;: 375,
            &quot;name&quot;: &quot;Cheating&quot;,
            &quot;slug&quot;: &quot;cheating&quot;
        },
        {
            &quot;id&quot;: 179,
            &quot;name&quot;: &quot;Cheerleading&quot;,
            &quot;slug&quot;: &quot;cheerleading&quot;
        },
        {
            &quot;id&quot;: 48,
            &quot;name&quot;: &quot;Chibi&quot;,
            &quot;slug&quot;: &quot;chibi&quot;
        },
        {
            &quot;id&quot;: 89,
            &quot;name&quot;: &quot;Chimera&quot;,
            &quot;slug&quot;: &quot;chimera&quot;
        },
        {
            &quot;id&quot;: 206,
            &quot;name&quot;: &quot;Chuunibyou&quot;,
            &quot;slug&quot;: &quot;chuunibyou&quot;
        },
        {
            &quot;id&quot;: 269,
            &quot;name&quot;: &quot;Circus&quot;,
            &quot;slug&quot;: &quot;circus&quot;
        },
        {
            &quot;id&quot;: 217,
            &quot;name&quot;: &quot;Class Struggle&quot;,
            &quot;slug&quot;: &quot;class-struggle&quot;
        },
        {
            &quot;id&quot;: 286,
            &quot;name&quot;: &quot;Classic Literature&quot;,
            &quot;slug&quot;: &quot;classic-literature&quot;
        },
        {
            &quot;id&quot;: 193,
            &quot;name&quot;: &quot;Classical Music&quot;,
            &quot;slug&quot;: &quot;classical-music&quot;
        },
        {
            &quot;id&quot;: 140,
            &quot;name&quot;: &quot;Clone&quot;,
            &quot;slug&quot;: &quot;clone&quot;
        },
        {
            &quot;id&quot;: 181,
            &quot;name&quot;: &quot;Coastal&quot;,
            &quot;slug&quot;: &quot;coastal&quot;
        },
        {
            &quot;id&quot;: 198,
            &quot;name&quot;: &quot;Cohabitation&quot;,
            &quot;slug&quot;: &quot;cohabitation&quot;
        },
        {
            &quot;id&quot;: 108,
            &quot;name&quot;: &quot;College&quot;,
            &quot;slug&quot;: &quot;college&quot;
        },
        {
            &quot;id&quot;: 84,
            &quot;name&quot;: &quot;Comedy&quot;,
            &quot;slug&quot;: &quot;comedy&quot;
        },
        {
            &quot;id&quot;: 26,
            &quot;name&quot;: &quot;Coming of Age&quot;,
            &quot;slug&quot;: &quot;coming-of-age&quot;
        },
        {
            &quot;id&quot;: 115,
            &quot;name&quot;: &quot;Conspiracy&quot;,
            &quot;slug&quot;: &quot;conspiracy&quot;
        },
        {
            &quot;id&quot;: 254,
            &quot;name&quot;: &quot;Cosmic Horror&quot;,
            &quot;slug&quot;: &quot;cosmic-horror&quot;
        },
        {
            &quot;id&quot;: 288,
            &quot;name&quot;: &quot;Cosplay&quot;,
            &quot;slug&quot;: &quot;cosplay&quot;
        },
        {
            &quot;id&quot;: 268,
            &quot;name&quot;: &quot;Cowboys&quot;,
            &quot;slug&quot;: &quot;cowboys&quot;
        },
        {
            &quot;id&quot;: 280,
            &quot;name&quot;: &quot;Creature Taming&quot;,
            &quot;slug&quot;: &quot;creature-taming&quot;
        },
        {
            &quot;id&quot;: 54,
            &quot;name&quot;: &quot;Crime&quot;,
            &quot;slug&quot;: &quot;crime&quot;
        },
        {
            &quot;id&quot;: 165,
            &quot;name&quot;: &quot;Criminal Organization&quot;,
            &quot;slug&quot;: &quot;criminal-organization&quot;
        },
        {
            &quot;id&quot;: 155,
            &quot;name&quot;: &quot;Crossdressing&quot;,
            &quot;slug&quot;: &quot;crossdressing&quot;
        },
        {
            &quot;id&quot;: 345,
            &quot;name&quot;: &quot;Crossover&quot;,
            &quot;slug&quot;: &quot;crossover&quot;
        },
        {
            &quot;id&quot;: 110,
            &quot;name&quot;: &quot;Cult&quot;,
            &quot;slug&quot;: &quot;cult&quot;
        },
        {
            &quot;id&quot;: 87,
            &quot;name&quot;: &quot;Cultivation&quot;,
            &quot;slug&quot;: &quot;cultivation&quot;
        },
        {
            &quot;id&quot;: 425,
            &quot;name&quot;: &quot;Cumflation&quot;,
            &quot;slug&quot;: &quot;cumflation&quot;
        },
        {
            &quot;id&quot;: 361,
            &quot;name&quot;: &quot;Cunnilingus&quot;,
            &quot;slug&quot;: &quot;cunnilingus&quot;
        },
        {
            &quot;id&quot;: 47,
            &quot;name&quot;: &quot;Curses&quot;,
            &quot;slug&quot;: &quot;curses&quot;
        },
        {
            &quot;id&quot;: 210,
            &quot;name&quot;: &quot;Cute Boys Doing Cute Things&quot;,
            &quot;slug&quot;: &quot;cute-boys-doing-cute-things&quot;
        },
        {
            &quot;id&quot;: 312,
            &quot;name&quot;: &quot;Cute Girls Doing Cute Things&quot;,
            &quot;slug&quot;: &quot;cute-girls-doing-cute-things&quot;
        },
        {
            &quot;id&quot;: 267,
            &quot;name&quot;: &quot;Cyberpunk&quot;,
            &quot;slug&quot;: &quot;cyberpunk&quot;
        },
        {
            &quot;id&quot;: 103,
            &quot;name&quot;: &quot;Cyborg&quot;,
            &quot;slug&quot;: &quot;cyborg&quot;
        },
        {
            &quot;id&quot;: 351,
            &quot;name&quot;: &quot;Cycling&quot;,
            &quot;slug&quot;: &quot;cycling&quot;
        },
        {
            &quot;id&quot;: 410,
            &quot;name&quot;: &quot;DILF&quot;,
            &quot;slug&quot;: &quot;dilf&quot;
        },
        {
            &quot;id&quot;: 355,
            &quot;name&quot;: &quot;Dancing&quot;,
            &quot;slug&quot;: &quot;dancing&quot;
        },
        {
            &quot;id&quot;: 158,
            &quot;name&quot;: &quot;Death Game&quot;,
            &quot;slug&quot;: &quot;death-game&quot;
        },
        {
            &quot;id&quot;: 421,
            &quot;name&quot;: &quot;Deepthroat&quot;,
            &quot;slug&quot;: &quot;deepthroat&quot;
        },
        {
            &quot;id&quot;: 363,
            &quot;name&quot;: &quot;Defloration&quot;,
            &quot;slug&quot;: &quot;defloration&quot;
        },
        {
            &quot;id&quot;: 189,
            &quot;name&quot;: &quot;Delinquents&quot;,
            &quot;slug&quot;: &quot;delinquents&quot;
        },
        {
            &quot;id&quot;: 39,
            &quot;name&quot;: &quot;Demons&quot;,
            &quot;slug&quot;: &quot;demons&quot;
        },
        {
            &quot;id&quot;: 205,
            &quot;name&quot;: &quot;Denpa&quot;,
            &quot;slug&quot;: &quot;denpa&quot;
        },
        {
            &quot;id&quot;: 124,
            &quot;name&quot;: &quot;Desert&quot;,
            &quot;slug&quot;: &quot;desert&quot;
        },
        {
            &quot;id&quot;: 55,
            &quot;name&quot;: &quot;Detective&quot;,
            &quot;slug&quot;: &quot;detective&quot;
        },
        {
            &quot;id&quot;: 332,
            &quot;name&quot;: &quot;Dinosaurs&quot;,
            &quot;slug&quot;: &quot;dinosaurs&quot;
        },
        {
            &quot;id&quot;: 149,
            &quot;name&quot;: &quot;Disability&quot;,
            &quot;slug&quot;: &quot;disability&quot;
        },
        {
            &quot;id&quot;: 73,
            &quot;name&quot;: &quot;Dissociative Identities&quot;,
            &quot;slug&quot;: &quot;dissociative-identities&quot;
        },
        {
            &quot;id&quot;: 412,
            &quot;name&quot;: &quot;Double Penetration&quot;,
            &quot;slug&quot;: &quot;double-penetration&quot;
        },
        {
            &quot;id&quot;: 127,
            &quot;name&quot;: &quot;Dragons&quot;,
            &quot;slug&quot;: &quot;dragons&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;name&quot;: &quot;Drama&quot;,
            &quot;slug&quot;: &quot;drama&quot;
        },
        {
            &quot;id&quot;: 246,
            &quot;name&quot;: &quot;Drawing&quot;,
            &quot;slug&quot;: &quot;drawing&quot;
        },
        {
            &quot;id&quot;: 131,
            &quot;name&quot;: &quot;Drugs&quot;,
            &quot;slug&quot;: &quot;drugs&quot;
        },
        {
            &quot;id&quot;: 237,
            &quot;name&quot;: &quot;Dullahan&quot;,
            &quot;slug&quot;: &quot;dullahan&quot;
        },
        {
            &quot;id&quot;: 220,
            &quot;name&quot;: &quot;Dungeon&quot;,
            &quot;slug&quot;: &quot;dungeon&quot;
        },
        {
            &quot;id&quot;: 18,
            &quot;name&quot;: &quot;Dystopian&quot;,
            &quot;slug&quot;: &quot;dystopian&quot;
        },
        {
            &quot;id&quot;: 348,
            &quot;name&quot;: &quot;E-Sports&quot;,
            &quot;slug&quot;: &quot;e-sports&quot;
        },
        {
            &quot;id&quot;: 223,
            &quot;name&quot;: &quot;Ecchi&quot;,
            &quot;slug&quot;: &quot;ecchi&quot;
        },
        {
            &quot;id&quot;: 292,
            &quot;name&quot;: &quot;Eco-Horror&quot;,
            &quot;slug&quot;: &quot;eco-horror&quot;
        },
        {
            &quot;id&quot;: 273,
            &quot;name&quot;: &quot;Economics&quot;,
            &quot;slug&quot;: &quot;economics&quot;
        },
        {
            &quot;id&quot;: 228,
            &quot;name&quot;: &quot;Educational&quot;,
            &quot;slug&quot;: &quot;educational&quot;
        },
        {
            &quot;id&quot;: 305,
            &quot;name&quot;: &quot;Elderly Protagonist&quot;,
            &quot;slug&quot;: &quot;elderly-protagonist&quot;
        },
        {
            &quot;id&quot;: 200,
            &quot;name&quot;: &quot;Elf&quot;,
            &quot;slug&quot;: &quot;elf&quot;
        },
        {
            &quot;id&quot;: 20,
            &quot;name&quot;: &quot;Ensemble Cast&quot;,
            &quot;slug&quot;: &quot;ensemble-cast&quot;
        },
        {
            &quot;id&quot;: 91,
            &quot;name&quot;: &quot;Environmental&quot;,
            &quot;slug&quot;: &quot;environmental&quot;
        },
        {
            &quot;id&quot;: 185,
            &quot;name&quot;: &quot;Episodic&quot;,
            &quot;slug&quot;: &quot;episodic&quot;
        },
        {
            &quot;id&quot;: 401,
            &quot;name&quot;: &quot;Ero Guro&quot;,
            &quot;slug&quot;: &quot;ero-guro&quot;
        },
        {
            &quot;id&quot;: 22,
            &quot;name&quot;: &quot;Espionage&quot;,
            &quot;slug&quot;: &quot;espionage&quot;
        },
        {
            &quot;id&quot;: 167,
            &quot;name&quot;: &quot;Estranged Family&quot;,
            &quot;slug&quot;: &quot;estranged-family&quot;
        },
        {
            &quot;id&quot;: 287,
            &quot;name&quot;: &quot;Exhibitionism&quot;,
            &quot;slug&quot;: &quot;exhibitionism&quot;
        },
        {
            &quot;id&quot;: 72,
            &quot;name&quot;: &quot;Exorcism&quot;,
            &quot;slug&quot;: &quot;exorcism&quot;
        },
        {
            &quot;id&quot;: 370,
            &quot;name&quot;: &quot;Facial&quot;,
            &quot;slug&quot;: &quot;facial&quot;
        },
        {
            &quot;id&quot;: 132,
            &quot;name&quot;: &quot;Fairy&quot;,
            &quot;slug&quot;: &quot;fairy&quot;
        },
        {
            &quot;id&quot;: 298,
            &quot;name&quot;: &quot;Fairy Tale&quot;,
            &quot;slug&quot;: &quot;fairy-tale&quot;
        },
        {
            &quot;id&quot;: 226,
            &quot;name&quot;: &quot;Fake Relationship&quot;,
            &quot;slug&quot;: &quot;fake-relationship&quot;
        },
        {
            &quot;id&quot;: 191,
            &quot;name&quot;: &quot;Family Life&quot;,
            &quot;slug&quot;: &quot;family-life&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;name&quot;: &quot;Fantasy&quot;,
            &quot;slug&quot;: &quot;fantasy&quot;
        },
        {
            &quot;id&quot;: 295,
            &quot;name&quot;: &quot;Fashion&quot;,
            &quot;slug&quot;: &quot;fashion&quot;
        },
        {
            &quot;id&quot;: 320,
            &quot;name&quot;: &quot;Feet&quot;,
            &quot;slug&quot;: &quot;feet&quot;
        },
        {
            &quot;id&quot;: 359,
            &quot;name&quot;: &quot;Fellatio&quot;,
            &quot;slug&quot;: &quot;fellatio&quot;
        },
        {
            &quot;id&quot;: 161,
            &quot;name&quot;: &quot;Female Harem&quot;,
            &quot;slug&quot;: &quot;female-harem&quot;
        },
        {
            &quot;id&quot;: 177,
            &quot;name&quot;: &quot;Female Protagonist&quot;,
            &quot;slug&quot;: &quot;female-protagonist&quot;
        },
        {
            &quot;id&quot;: 186,
            &quot;name&quot;: &quot;Femboy&quot;,
            &quot;slug&quot;: &quot;femboy&quot;
        },
        {
            &quot;id&quot;: 243,
            &quot;name&quot;: &quot;Femdom&quot;,
            &quot;slug&quot;: &quot;femdom&quot;
        },
        {
            &quot;id&quot;: 374,
            &quot;name&quot;: &quot;Fencing&quot;,
            &quot;slug&quot;: &quot;fencing&quot;
        },
        {
            &quot;id&quot;: 306,
            &quot;name&quot;: &quot;Filmmaking&quot;,
            &quot;slug&quot;: &quot;filmmaking&quot;
        },
        {
            &quot;id&quot;: 417,
            &quot;name&quot;: &quot;Fingering&quot;,
            &quot;slug&quot;: &quot;fingering&quot;
        },
        {
            &quot;id&quot;: 265,
            &quot;name&quot;: &quot;Firefighters&quot;,
            &quot;slug&quot;: &quot;firefighters&quot;
        },
        {
            &quot;id&quot;: 162,
            &quot;name&quot;: &quot;Fishing&quot;,
            &quot;slug&quot;: &quot;fishing&quot;
        },
        {
            &quot;id&quot;: 430,
            &quot;name&quot;: &quot;Fisting&quot;,
            &quot;slug&quot;: &quot;fisting&quot;
        },
        {
            &quot;id&quot;: 190,
            &quot;name&quot;: &quot;Fitness&quot;,
            &quot;slug&quot;: &quot;fitness&quot;
        },
        {
            &quot;id&quot;: 353,
            &quot;name&quot;: &quot;Flash&quot;,
            &quot;slug&quot;: &quot;flash&quot;
        },
        {
            &quot;id&quot;: 369,
            &quot;name&quot;: &quot;Flat Chest&quot;,
            &quot;slug&quot;: &quot;flat-chest&quot;
        },
        {
            &quot;id&quot;: 51,
            &quot;name&quot;: &quot;Food&quot;,
            &quot;slug&quot;: &quot;food&quot;
        },
        {
            &quot;id&quot;: 323,
            &quot;name&quot;: &quot;Football&quot;,
            &quot;slug&quot;: &quot;football&quot;
        },
        {
            &quot;id&quot;: 148,
            &quot;name&quot;: &quot;Foreign&quot;,
            &quot;slug&quot;: &quot;foreign&quot;
        },
        {
            &quot;id&quot;: 113,
            &quot;name&quot;: &quot;Found Family&quot;,
            &quot;slug&quot;: &quot;found-family&quot;
        },
        {
            &quot;id&quot;: 58,
            &quot;name&quot;: &quot;Fugitive&quot;,
            &quot;slug&quot;: &quot;fugitive&quot;
        },
        {
            &quot;id&quot;: 330,
            &quot;name&quot;: &quot;Full CGI&quot;,
            &quot;slug&quot;: &quot;full-cgi&quot;
        },
        {
            &quot;id&quot;: 337,
            &quot;name&quot;: &quot;Futanari&quot;,
            &quot;slug&quot;: &quot;futanari&quot;
        },
        {
            &quot;id&quot;: 169,
            &quot;name&quot;: &quot;Gambling&quot;,
            &quot;slug&quot;: &quot;gambling&quot;
        },
        {
            &quot;id&quot;: 93,
            &quot;name&quot;: &quot;Gangs&quot;,
            &quot;slug&quot;: &quot;gangs&quot;
        },
        {
            &quot;id&quot;: 138,
            &quot;name&quot;: &quot;Gender Bending&quot;,
            &quot;slug&quot;: &quot;gender-bending&quot;
        },
        {
            &quot;id&quot;: 188,
            &quot;name&quot;: &quot;Ghost&quot;,
            &quot;slug&quot;: &quot;ghost&quot;
        },
        {
            &quot;id&quot;: 329,
            &quot;name&quot;: &quot;Go&quot;,
            &quot;slug&quot;: &quot;go&quot;
        },
        {
            &quot;id&quot;: 279,
            &quot;name&quot;: &quot;Goblin&quot;,
            &quot;slug&quot;: &quot;goblin&quot;
        },
        {
            &quot;id&quot;: 61,
            &quot;name&quot;: &quot;Gods&quot;,
            &quot;slug&quot;: &quot;gods&quot;
        },
        {
            &quot;id&quot;: 388,
            &quot;name&quot;: &quot;Golf&quot;,
            &quot;slug&quot;: &quot;golf&quot;
        },
        {
            &quot;id&quot;: 14,
            &quot;name&quot;: &quot;Gore&quot;,
            &quot;slug&quot;: &quot;gore&quot;
        },
        {
            &quot;id&quot;: 367,
            &quot;name&quot;: &quot;Group Sex&quot;,
            &quot;slug&quot;: &quot;group-sex&quot;
        },
        {
            &quot;id&quot;: 123,
            &quot;name&quot;: &quot;Guns&quot;,
            &quot;slug&quot;: &quot;guns&quot;
        },
        {
            &quot;id&quot;: 258,
            &quot;name&quot;: &quot;Gyaru&quot;,
            &quot;slug&quot;: &quot;gyaru&quot;
        },
        {
            &quot;id&quot;: 431,
            &quot;name&quot;: &quot;Hair Pulling&quot;,
            &quot;slug&quot;: &quot;hair-pulling&quot;
        },
        {
            &quot;id&quot;: 398,
            &quot;name&quot;: &quot;Handball&quot;,
            &quot;slug&quot;: &quot;handball&quot;
        },
        {
            &quot;id&quot;: 368,
            &quot;name&quot;: &quot;Handjob&quot;,
            &quot;slug&quot;: &quot;handjob&quot;
        },
        {
            &quot;id&quot;: 13,
            &quot;name&quot;: &quot;Henshin&quot;,
            &quot;slug&quot;: &quot;henshin&quot;
        },
        {
            &quot;id&quot;: 405,
            &quot;name&quot;: &quot;Hentai&quot;,
            &quot;slug&quot;: &quot;hentai&quot;
        },
        {
            &quot;id&quot;: 109,
            &quot;name&quot;: &quot;Heterosexual&quot;,
            &quot;slug&quot;: &quot;heterosexual&quot;
        },
        {
            &quot;id&quot;: 215,
            &quot;name&quot;: &quot;Hikikomori&quot;,
            &quot;slug&quot;: &quot;hikikomori&quot;
        },
        {
            &quot;id&quot;: 307,
            &quot;name&quot;: &quot;Hip-hop Music&quot;,
            &quot;slug&quot;: &quot;hip-hop-music&quot;
        },
        {
            &quot;id&quot;: 44,
            &quot;name&quot;: &quot;Historical&quot;,
            &quot;slug&quot;: &quot;historical&quot;
        },
        {
            &quot;id&quot;: 214,
            &quot;name&quot;: &quot;Homeless&quot;,
            &quot;slug&quot;: &quot;homeless&quot;
        },
        {
            &quot;id&quot;: 106,
            &quot;name&quot;: &quot;Horror&quot;,
            &quot;slug&quot;: &quot;horror&quot;
        },
        {
            &quot;id&quot;: 264,
            &quot;name&quot;: &quot;Horticulture&quot;,
            &quot;slug&quot;: &quot;horticulture&quot;
        },
        {
            &quot;id&quot;: 362,
            &quot;name&quot;: &quot;Human Pet&quot;,
            &quot;slug&quot;: &quot;human-pet&quot;
        },
        {
            &quot;id&quot;: 284,
            &quot;name&quot;: &quot;Hypersexuality&quot;,
            &quot;slug&quot;: &quot;hypersexuality&quot;
        },
        {
            &quot;id&quot;: 259,
            &quot;name&quot;: &quot;Ice Skating&quot;,
            &quot;slug&quot;: &quot;ice-skating&quot;
        },
        {
            &quot;id&quot;: 216,
            &quot;name&quot;: &quot;Idol&quot;,
            &quot;slug&quot;: &quot;idol&quot;
        },
        {
            &quot;id&quot;: 281,
            &quot;name&quot;: &quot;Incest&quot;,
            &quot;slug&quot;: &quot;incest&quot;
        },
        {
            &quot;id&quot;: 319,
            &quot;name&quot;: &quot;Indigenous Cultures&quot;,
            &quot;slug&quot;: &quot;indigenous-cultures&quot;
        },
        {
            &quot;id&quot;: 257,
            &quot;name&quot;: &quot;Inn&quot;,
            &quot;slug&quot;: &quot;inn&quot;
        },
        {
            &quot;id&quot;: 164,
            &quot;name&quot;: &quot;Inseki&quot;,
            &quot;slug&quot;: &quot;inseki&quot;
        },
        {
            &quot;id&quot;: 350,
            &quot;name&quot;: &quot;Irrumatio&quot;,
            &quot;slug&quot;: &quot;irrumatio&quot;
        },
        {
            &quot;id&quot;: 157,
            &quot;name&quot;: &quot;Isekai&quot;,
            &quot;slug&quot;: &quot;isekai&quot;
        },
        {
            &quot;id&quot;: 290,
            &quot;name&quot;: &quot;Iyashikei&quot;,
            &quot;slug&quot;: &quot;iyashikei&quot;
        },
        {
            &quot;id&quot;: 387,
            &quot;name&quot;: &quot;Jazz Music&quot;,
            &quot;slug&quot;: &quot;jazz-music&quot;
        },
        {
            &quot;id&quot;: 315,
            &quot;name&quot;: &quot;Josei&quot;,
            &quot;slug&quot;: &quot;josei&quot;
        },
        {
            &quot;id&quot;: 225,
            &quot;name&quot;: &quot;Judo&quot;,
            &quot;slug&quot;: &quot;judo&quot;
        },
        {
            &quot;id&quot;: 143,
            &quot;name&quot;: &quot;Kabuki&quot;,
            &quot;slug&quot;: &quot;kabuki&quot;
        },
        {
            &quot;id&quot;: 5,
            &quot;name&quot;: &quot;Kaiju&quot;,
            &quot;slug&quot;: &quot;kaiju&quot;
        },
        {
            &quot;id&quot;: 377,
            &quot;name&quot;: &quot;Karuta&quot;,
            &quot;slug&quot;: &quot;karuta&quot;
        },
        {
            &quot;id&quot;: 202,
            &quot;name&quot;: &quot;Kemonomimi&quot;,
            &quot;slug&quot;: &quot;kemonomimi&quot;
        },
        {
            &quot;id&quot;: 328,
            &quot;name&quot;: &quot;Kids&quot;,
            &quot;slug&quot;: &quot;kids&quot;
        },
        {
            &quot;id&quot;: 224,
            &quot;name&quot;: &quot;Kingdom Management&quot;,
            &quot;slug&quot;: &quot;kingdom-management&quot;
        },
        {
            &quot;id&quot;: 344,
            &quot;name&quot;: &quot;Konbini&quot;,
            &quot;slug&quot;: &quot;konbini&quot;
        },
        {
            &quot;id&quot;: 24,
            &quot;name&quot;: &quot;Kuudere&quot;,
            &quot;slug&quot;: &quot;kuudere&quot;
        },
        {
            &quot;id&quot;: 146,
            &quot;name&quot;: &quot;LGBTQ+ Themes&quot;,
            &quot;slug&quot;: &quot;lgbtq-themes&quot;
        },
        {
            &quot;id&quot;: 399,
            &quot;name&quot;: &quot;Lacrosse&quot;,
            &quot;slug&quot;: &quot;lacrosse&quot;
        },
        {
            &quot;id&quot;: 384,
            &quot;name&quot;: &quot;Lactation&quot;,
            &quot;slug&quot;: &quot;lactation&quot;
        },
        {
            &quot;id&quot;: 175,
            &quot;name&quot;: &quot;Language Barrier&quot;,
            &quot;slug&quot;: &quot;language-barrier&quot;
        },
        {
            &quot;id&quot;: 289,
            &quot;name&quot;: &quot;Large Breasts&quot;,
            &quot;slug&quot;: &quot;large-breasts&quot;
        },
        {
            &quot;id&quot;: 118,
            &quot;name&quot;: &quot;Lost Civilization&quot;,
            &quot;slug&quot;: &quot;lost-civilization&quot;
        },
        {
            &quot;id&quot;: 168,
            &quot;name&quot;: &quot;Love Triangle&quot;,
            &quot;slug&quot;: &quot;love-triangle&quot;
        },
        {
            &quot;id&quot;: 381,
            &quot;name&quot;: &quot;MILF&quot;,
            &quot;slug&quot;: &quot;milf&quot;
        },
        {
            &quot;id&quot;: 92,
            &quot;name&quot;: &quot;Mafia&quot;,
            &quot;slug&quot;: &quot;mafia&quot;
        },
        {
            &quot;id&quot;: 74,
            &quot;name&quot;: &quot;Magic&quot;,
            &quot;slug&quot;: &quot;magic&quot;
        },
        {
            &quot;id&quot;: 283,
            &quot;name&quot;: &quot;Mahjong&quot;,
            &quot;slug&quot;: &quot;mahjong&quot;
        },
        {
            &quot;id&quot;: 317,
            &quot;name&quot;: &quot;Mahou Shoujo&quot;,
            &quot;slug&quot;: &quot;mahou-shoujo&quot;
        },
        {
            &quot;id&quot;: 199,
            &quot;name&quot;: &quot;Maids&quot;,
            &quot;slug&quot;: &quot;maids&quot;
        },
        {
            &quot;id&quot;: 297,
            &quot;name&quot;: &quot;Makeup&quot;,
            &quot;slug&quot;: &quot;makeup&quot;
        },
        {
            &quot;id&quot;: 321,
            &quot;name&quot;: &quot;Male Harem&quot;,
            &quot;slug&quot;: &quot;male-harem&quot;
        },
        {
            &quot;id&quot;: 402,
            &quot;name&quot;: &quot;Male Pregnancy&quot;,
            &quot;slug&quot;: &quot;male-pregnancy&quot;
        },
        {
            &quot;id&quot;: 12,
            &quot;name&quot;: &quot;Male Protagonist&quot;,
            &quot;slug&quot;: &quot;male-protagonist&quot;
        },
        {
            &quot;id&quot;: 357,
            &quot;name&quot;: &quot;Manzai&quot;,
            &quot;slug&quot;: &quot;manzai&quot;
        },
        {
            &quot;id&quot;: 128,
            &quot;name&quot;: &quot;Marriage&quot;,
            &quot;slug&quot;: &quot;marriage&quot;
        },
        {
            &quot;id&quot;: 75,
            &quot;name&quot;: &quot;Martial Arts&quot;,
            &quot;slug&quot;: &quot;martial-arts&quot;
        },
        {
            &quot;id&quot;: 235,
            &quot;name&quot;: &quot;Masochism&quot;,
            &quot;slug&quot;: &quot;masochism&quot;
        },
        {
            &quot;id&quot;: 285,
            &quot;name&quot;: &quot;Masturbation&quot;,
            &quot;slug&quot;: &quot;masturbation&quot;
        },
        {
            &quot;id&quot;: 407,
            &quot;name&quot;: &quot;Matchmaking&quot;,
            &quot;slug&quot;: &quot;matchmaking&quot;
        },
        {
            &quot;id&quot;: 422,
            &quot;name&quot;: &quot;Mating Press&quot;,
            &quot;slug&quot;: &quot;mating-press&quot;
        },
        {
            &quot;id&quot;: 111,
            &quot;name&quot;: &quot;Matriarchy&quot;,
            &quot;slug&quot;: &quot;matriarchy&quot;
        },
        {
            &quot;id&quot;: 241,
            &quot;name&quot;: &quot;Mecha&quot;,
            &quot;slug&quot;: &quot;mecha&quot;
        },
        {
            &quot;id&quot;: 121,
            &quot;name&quot;: &quot;Medicine&quot;,
            &quot;slug&quot;: &quot;medicine&quot;
        },
        {
            &quot;id&quot;: 29,
            &quot;name&quot;: &quot;Medieval&quot;,
            &quot;slug&quot;: &quot;medieval&quot;
        },
        {
            &quot;id&quot;: 16,
            &quot;name&quot;: &quot;Memory Manipulation&quot;,
            &quot;slug&quot;: &quot;memory-manipulation&quot;
        },
        {
            &quot;id&quot;: 136,
            &quot;name&quot;: &quot;Mermaid&quot;,
            &quot;slug&quot;: &quot;mermaid&quot;
        },
        {
            &quot;id&quot;: 203,
            &quot;name&quot;: &quot;Meta&quot;,
            &quot;slug&quot;: &quot;meta&quot;
        },
        {
            &quot;id&quot;: 394,
            &quot;name&quot;: &quot;Metal Music&quot;,
            &quot;slug&quot;: &quot;metal-music&quot;
        },
        {
            &quot;id&quot;: 7,
            &quot;name&quot;: &quot;Military&quot;,
            &quot;slug&quot;: &quot;military&quot;
        },
        {
            &quot;id&quot;: 300,
            &quot;name&quot;: &quot;Mixed Gender Harem&quot;,
            &quot;slug&quot;: &quot;mixed-gender-harem&quot;
        },
        {
            &quot;id&quot;: 303,
            &quot;name&quot;: &quot;Mixed Media&quot;,
            &quot;slug&quot;: &quot;mixed-media&quot;
        },
        {
            &quot;id&quot;: 396,
            &quot;name&quot;: &quot;Modeling&quot;,
            &quot;slug&quot;: &quot;modeling&quot;
        },
        {
            &quot;id&quot;: 119,
            &quot;name&quot;: &quot;Monster Boy&quot;,
            &quot;slug&quot;: &quot;monster-boy&quot;
        },
        {
            &quot;id&quot;: 42,
            &quot;name&quot;: &quot;Monster Girl&quot;,
            &quot;slug&quot;: &quot;monster-girl&quot;
        },
        {
            &quot;id&quot;: 277,
            &quot;name&quot;: &quot;Mopeds&quot;,
            &quot;slug&quot;: &quot;mopeds&quot;
        },
        {
            &quot;id&quot;: 276,
            &quot;name&quot;: &quot;Motorcycles&quot;,
            &quot;slug&quot;: &quot;motorcycles&quot;
        },
        {
            &quot;id&quot;: 403,
            &quot;name&quot;: &quot;Mountaineering&quot;,
            &quot;slug&quot;: &quot;mountaineering&quot;
        },
        {
            &quot;id&quot;: 192,
            &quot;name&quot;: &quot;Music&quot;,
            &quot;slug&quot;: &quot;music&quot;
        },
        {
            &quot;id&quot;: 141,
            &quot;name&quot;: &quot;Musical Theater&quot;,
            &quot;slug&quot;: &quot;musical-theater&quot;
        },
        {
            &quot;id&quot;: 4,
            &quot;name&quot;: &quot;Mystery&quot;,
            &quot;slug&quot;: &quot;mystery&quot;
        },
        {
            &quot;id&quot;: 43,
            &quot;name&quot;: &quot;Mythology&quot;,
            &quot;slug&quot;: &quot;mythology&quot;
        },
        {
            &quot;id&quot;: 360,
            &quot;name&quot;: &quot;Nakadashi&quot;,
            &quot;slug&quot;: &quot;nakadashi&quot;
        },
        {
            &quot;id&quot;: 347,
            &quot;name&quot;: &quot;Natural Disaster&quot;,
            &quot;slug&quot;: &quot;natural-disaster&quot;
        },
        {
            &quot;id&quot;: 150,
            &quot;name&quot;: &quot;Necromancy&quot;,
            &quot;slug&quot;: &quot;necromancy&quot;
        },
        {
            &quot;id&quot;: 204,
            &quot;name&quot;: &quot;Nekomimi&quot;,
            &quot;slug&quot;: &quot;nekomimi&quot;
        },
        {
            &quot;id&quot;: 282,
            &quot;name&quot;: &quot;Netorare&quot;,
            &quot;slug&quot;: &quot;netorare&quot;
        },
        {
            &quot;id&quot;: 429,
            &quot;name&quot;: &quot;Netorase&quot;,
            &quot;slug&quot;: &quot;netorase&quot;
        },
        {
            &quot;id&quot;: 418,
            &quot;name&quot;: &quot;Netori&quot;,
            &quot;slug&quot;: &quot;netori&quot;
        },
        {
            &quot;id&quot;: 137,
            &quot;name&quot;: &quot;Ninja&quot;,
            &quot;slug&quot;: &quot;ninja&quot;
        },
        {
            &quot;id&quot;: 393,
            &quot;name&quot;: &quot;No Dialogue&quot;,
            &quot;slug&quot;: &quot;no-dialogue&quot;
        },
        {
            &quot;id&quot;: 266,
            &quot;name&quot;: &quot;Noir&quot;,
            &quot;slug&quot;: &quot;noir&quot;
        },
        {
            &quot;id&quot;: 426,
            &quot;name&quot;: &quot;Non-fiction&quot;,
            &quot;slug&quot;: &quot;non-fiction&quot;
        },
        {
            &quot;id&quot;: 130,
            &quot;name&quot;: &quot;Nudity&quot;,
            &quot;slug&quot;: &quot;nudity&quot;
        },
        {
            &quot;id&quot;: 219,
            &quot;name&quot;: &quot;Nun&quot;,
            &quot;slug&quot;: &quot;nun&quot;
        },
        {
            &quot;id&quot;: 316,
            &quot;name&quot;: &quot;Office&quot;,
            &quot;slug&quot;: &quot;office&quot;
        },
        {
            &quot;id&quot;: 313,
            &quot;name&quot;: &quot;Office Lady&quot;,
            &quot;slug&quot;: &quot;office-lady&quot;
        },
        {
            &quot;id&quot;: 270,
            &quot;name&quot;: &quot;Oiran&quot;,
            &quot;slug&quot;: &quot;oiran&quot;
        },
        {
            &quot;id&quot;: 221,
            &quot;name&quot;: &quot;Ojou-sama&quot;,
            &quot;slug&quot;: &quot;ojou-sama&quot;
        },
        {
            &quot;id&quot;: 415,
            &quot;name&quot;: &quot;Omegaverse&quot;,
            &quot;slug&quot;: &quot;omegaverse&quot;
        },
        {
            &quot;id&quot;: 21,
            &quot;name&quot;: &quot;Orphan&quot;,
            &quot;slug&quot;: &quot;orphan&quot;
        },
        {
            &quot;id&quot;: 207,
            &quot;name&quot;: &quot;Otaku Culture&quot;,
            &quot;slug&quot;: &quot;otaku-culture&quot;
        },
        {
            &quot;id&quot;: 222,
            &quot;name&quot;: &quot;Outdoor Activities&quot;,
            &quot;slug&quot;: &quot;outdoor-activities&quot;
        },
        {
            &quot;id&quot;: 176,
            &quot;name&quot;: &quot;POV&quot;,
            &quot;slug&quot;: &quot;pov&quot;
        },
        {
            &quot;id&quot;: 250,
            &quot;name&quot;: &quot;Pandemic&quot;,
            &quot;slug&quot;: &quot;pandemic&quot;
        },
        {
            &quot;id&quot;: 227,
            &quot;name&quot;: &quot;Parenthood&quot;,
            &quot;slug&quot;: &quot;parenthood&quot;
        },
        {
            &quot;id&quot;: 339,
            &quot;name&quot;: &quot;Parkour&quot;,
            &quot;slug&quot;: &quot;parkour&quot;
        },
        {
            &quot;id&quot;: 101,
            &quot;name&quot;: &quot;Parody&quot;,
            &quot;slug&quot;: &quot;parody&quot;
        },
        {
            &quot;id&quot;: 413,
            &quot;name&quot;: &quot;Pet Play&quot;,
            &quot;slug&quot;: &quot;pet-play&quot;
        },
        {
            &quot;id&quot;: 59,
            &quot;name&quot;: &quot;Philosophy&quot;,
            &quot;slug&quot;: &quot;philosophy&quot;
        },
        {
            &quot;id&quot;: 296,
            &quot;name&quot;: &quot;Photography&quot;,
            &quot;slug&quot;: &quot;photography&quot;
        },
        {
            &quot;id&quot;: 112,
            &quot;name&quot;: &quot;Pirates&quot;,
            &quot;slug&quot;: &quot;pirates&quot;
        },
        {
            &quot;id&quot;: 272,
            &quot;name&quot;: &quot;Poker&quot;,
            &quot;slug&quot;: &quot;poker&quot;
        },
        {
            &quot;id&quot;: 57,
            &quot;name&quot;: &quot;Police&quot;,
            &quot;slug&quot;: &quot;police&quot;
        },
        {
            &quot;id&quot;: 95,
            &quot;name&quot;: &quot;Politics&quot;,
            &quot;slug&quot;: &quot;politics&quot;
        },
        {
            &quot;id&quot;: 271,
            &quot;name&quot;: &quot;Polyamorous&quot;,
            &quot;slug&quot;: &quot;polyamorous&quot;
        },
        {
            &quot;id&quot;: 9,
            &quot;name&quot;: &quot;Post-Apocalyptic&quot;,
            &quot;slug&quot;: &quot;post-apocalyptic&quot;
        },
        {
            &quot;id&quot;: 249,
            &quot;name&quot;: &quot;Pregnancy&quot;,
            &quot;slug&quot;: &quot;pregnancy&quot;
        },
        {
            &quot;id&quot;: 60,
            &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
            &quot;slug&quot;: &quot;primarily-adult-cast&quot;
        },
        {
            &quot;id&quot;: 331,
            &quot;name&quot;: &quot;Primarily Animal Cast&quot;,
            &quot;slug&quot;: &quot;primarily-animal-cast&quot;
        },
        {
            &quot;id&quot;: 166,
            &quot;name&quot;: &quot;Primarily Child Cast&quot;,
            &quot;slug&quot;: &quot;primarily-child-cast&quot;
        },
        {
            &quot;id&quot;: 160,
            &quot;name&quot;: &quot;Primarily Female Cast&quot;,
            &quot;slug&quot;: &quot;primarily-female-cast&quot;
        },
        {
            &quot;id&quot;: 34,
            &quot;name&quot;: &quot;Primarily Male Cast&quot;,
            &quot;slug&quot;: &quot;primarily-male-cast&quot;
        },
        {
            &quot;id&quot;: 10,
            &quot;name&quot;: &quot;Primarily Teen Cast&quot;,
            &quot;slug&quot;: &quot;primarily-teen-cast&quot;
        },
        {
            &quot;id&quot;: 88,
            &quot;name&quot;: &quot;Prison&quot;,
            &quot;slug&quot;: &quot;prison&quot;
        },
        {
            &quot;id&quot;: 301,
            &quot;name&quot;: &quot;Prostitution&quot;,
            &quot;slug&quot;: &quot;prostitution&quot;
        },
        {
            &quot;id&quot;: 325,
            &quot;name&quot;: &quot;Proxy Battle&quot;,
            &quot;slug&quot;: &quot;proxy-battle&quot;
        },
        {
            &quot;id&quot;: 52,
            &quot;name&quot;: &quot;Psychological&quot;,
            &quot;slug&quot;: &quot;psychological&quot;
        },
        {
            &quot;id&quot;: 211,
            &quot;name&quot;: &quot;Psychosexual&quot;,
            &quot;slug&quot;: &quot;psychosexual&quot;
        },
        {
            &quot;id&quot;: 308,
            &quot;name&quot;: &quot;Public Sex&quot;,
            &quot;slug&quot;: &quot;public-sex&quot;
        },
        {
            &quot;id&quot;: 380,
            &quot;name&quot;: &quot;Puppetry&quot;,
            &quot;slug&quot;: &quot;puppetry&quot;
        },
        {
            &quot;id&quot;: 382,
            &quot;name&quot;: &quot;Rakugo&quot;,
            &quot;slug&quot;: &quot;rakugo&quot;
        },
        {
            &quot;id&quot;: 163,
            &quot;name&quot;: &quot;Rape&quot;,
            &quot;slug&quot;: &quot;rape&quot;
        },
        {
            &quot;id&quot;: 253,
            &quot;name&quot;: &quot;Real Robot&quot;,
            &quot;slug&quot;: &quot;real-robot&quot;
        },
        {
            &quot;id&quot;: 174,
            &quot;name&quot;: &quot;Rehabilitation&quot;,
            &quot;slug&quot;: &quot;rehabilitation&quot;
        },
        {
            &quot;id&quot;: 218,
            &quot;name&quot;: &quot;Reincarnation&quot;,
            &quot;slug&quot;: &quot;reincarnation&quot;
        },
        {
            &quot;id&quot;: 151,
            &quot;name&quot;: &quot;Religion&quot;,
            &quot;slug&quot;: &quot;religion&quot;
        },
        {
            &quot;id&quot;: 159,
            &quot;name&quot;: &quot;Rescue&quot;,
            &quot;slug&quot;: &quot;rescue&quot;
        },
        {
            &quot;id&quot;: 293,
            &quot;name&quot;: &quot;Restaurant&quot;,
            &quot;slug&quot;: &quot;restaurant&quot;
        },
        {
            &quot;id&quot;: 6,
            &quot;name&quot;: &quot;Revenge&quot;,
            &quot;slug&quot;: &quot;revenge&quot;
        },
        {
            &quot;id&quot;: 294,
            &quot;name&quot;: &quot;Reverse Isekai&quot;,
            &quot;slug&quot;: &quot;reverse-isekai&quot;
        },
        {
            &quot;id&quot;: 414,
            &quot;name&quot;: &quot;Rimjob&quot;,
            &quot;slug&quot;: &quot;rimjob&quot;
        },
        {
            &quot;id&quot;: 120,
            &quot;name&quot;: &quot;Robots&quot;,
            &quot;slug&quot;: &quot;robots&quot;
        },
        {
            &quot;id&quot;: 274,
            &quot;name&quot;: &quot;Rock Music&quot;,
            &quot;slug&quot;: &quot;rock-music&quot;
        },
        {
            &quot;id&quot;: 156,
            &quot;name&quot;: &quot;Romance&quot;,
            &quot;slug&quot;: &quot;romance&quot;
        },
        {
            &quot;id&quot;: 45,
            &quot;name&quot;: &quot;Rotoscoping&quot;,
            &quot;slug&quot;: &quot;rotoscoping&quot;
        },
        {
            &quot;id&quot;: 252,
            &quot;name&quot;: &quot;Royal Affairs&quot;,
            &quot;slug&quot;: &quot;royal-affairs&quot;
        },
        {
            &quot;id&quot;: 261,
            &quot;name&quot;: &quot;Rugby&quot;,
            &quot;slug&quot;: &quot;rugby&quot;
        },
        {
            &quot;id&quot;: 32,
            &quot;name&quot;: &quot;Rural&quot;,
            &quot;slug&quot;: &quot;rural&quot;
        },
        {
            &quot;id&quot;: 239,
            &quot;name&quot;: &quot;Sadism&quot;,
            &quot;slug&quot;: &quot;sadism&quot;
        },
        {
            &quot;id&quot;: 122,
            &quot;name&quot;: &quot;Samurai&quot;,
            &quot;slug&quot;: &quot;samurai&quot;
        },
        {
            &quot;id&quot;: 102,
            &quot;name&quot;: &quot;Satire&quot;,
            &quot;slug&quot;: &quot;satire&quot;
        },
        {
            &quot;id&quot;: 397,
            &quot;name&quot;: &quot;Scat&quot;,
            &quot;slug&quot;: &quot;scat&quot;
        },
        {
            &quot;id&quot;: 77,
            &quot;name&quot;: &quot;School&quot;,
            &quot;slug&quot;: &quot;school&quot;
        },
        {
            &quot;id&quot;: 187,
            &quot;name&quot;: &quot;School Club&quot;,
            &quot;slug&quot;: &quot;school-club&quot;
        },
        {
            &quot;id&quot;: 100,
            &quot;name&quot;: &quot;Sci-Fi&quot;,
            &quot;slug&quot;: &quot;sci-fi&quot;
        },
        {
            &quot;id&quot;: 409,
            &quot;name&quot;: &quot;Scissoring&quot;,
            &quot;slug&quot;: &quot;scissoring&quot;
        },
        {
            &quot;id&quot;: 341,
            &quot;name&quot;: &quot;Scuba Diving&quot;,
            &quot;slug&quot;: &quot;scuba-diving&quot;
        },
        {
            &quot;id&quot;: 104,
            &quot;name&quot;: &quot;Seinen&quot;,
            &quot;slug&quot;: &quot;seinen&quot;
        },
        {
            &quot;id&quot;: 395,
            &quot;name&quot;: &quot;Sex Toys&quot;,
            &quot;slug&quot;: &quot;sex-toys&quot;
        },
        {
            &quot;id&quot;: 76,
            &quot;name&quot;: &quot;Shapeshifting&quot;,
            &quot;slug&quot;: &quot;shapeshifting&quot;
        },
        {
            &quot;id&quot;: 406,
            &quot;name&quot;: &quot;Shimaidon&quot;,
            &quot;slug&quot;: &quot;shimaidon&quot;
        },
        {
            &quot;id&quot;: 114,
            &quot;name&quot;: &quot;Ships&quot;,
            &quot;slug&quot;: &quot;ships&quot;
        },
        {
            &quot;id&quot;: 96,
            &quot;name&quot;: &quot;Shogi&quot;,
            &quot;slug&quot;: &quot;shogi&quot;
        },
        {
            &quot;id&quot;: 318,
            &quot;name&quot;: &quot;Shoujo&quot;,
            &quot;slug&quot;: &quot;shoujo&quot;
        },
        {
            &quot;id&quot;: 25,
            &quot;name&quot;: &quot;Shounen&quot;,
            &quot;slug&quot;: &quot;shounen&quot;
        },
        {
            &quot;id&quot;: 172,
            &quot;name&quot;: &quot;Shrine Maiden&quot;,
            &quot;slug&quot;: &quot;shrine-maiden&quot;
        },
        {
            &quot;id&quot;: 338,
            &quot;name&quot;: &quot;Skateboarding&quot;,
            &quot;slug&quot;: &quot;skateboarding&quot;
        },
        {
            &quot;id&quot;: 125,
            &quot;name&quot;: &quot;Skeleton&quot;,
            &quot;slug&quot;: &quot;skeleton&quot;
        },
        {
            &quot;id&quot;: 79,
            &quot;name&quot;: &quot;Slapstick&quot;,
            &quot;slug&quot;: &quot;slapstick&quot;
        },
        {
            &quot;id&quot;: 117,
            &quot;name&quot;: &quot;Slavery&quot;,
            &quot;slug&quot;: &quot;slavery&quot;
        },
        {
            &quot;id&quot;: 173,
            &quot;name&quot;: &quot;Slice of Life&quot;,
            &quot;slug&quot;: &quot;slice-of-life&quot;
        },
        {
            &quot;id&quot;: 49,
            &quot;name&quot;: &quot;Snowscape&quot;,
            &quot;slug&quot;: &quot;snowscape&quot;
        },
        {
            &quot;id&quot;: 309,
            &quot;name&quot;: &quot;Software Development&quot;,
            &quot;slug&quot;: &quot;software-development&quot;
        },
        {
            &quot;id&quot;: 244,
            &quot;name&quot;: &quot;Space&quot;,
            &quot;slug&quot;: &quot;space&quot;
        },
        {
            &quot;id&quot;: 302,
            &quot;name&quot;: &quot;Space Opera&quot;,
            &quot;slug&quot;: &quot;space-opera&quot;
        },
        {
            &quot;id&quot;: 229,
            &quot;name&quot;: &quot;Spearplay&quot;,
            &quot;slug&quot;: &quot;spearplay&quot;
        },
        {
            &quot;id&quot;: 208,
            &quot;name&quot;: &quot;Sports&quot;,
            &quot;slug&quot;: &quot;sports&quot;
        },
        {
            &quot;id&quot;: 366,
            &quot;name&quot;: &quot;Squirting&quot;,
            &quot;slug&quot;: &quot;squirting&quot;
        },
        {
            &quot;id&quot;: 17,
            &quot;name&quot;: &quot;Steampunk&quot;,
            &quot;slug&quot;: &quot;steampunk&quot;
        },
        {
            &quot;id&quot;: 404,
            &quot;name&quot;: &quot;Stop Motion&quot;,
            &quot;slug&quot;: &quot;stop-motion&quot;
        },
        {
            &quot;id&quot;: 238,
            &quot;name&quot;: &quot;Succubus&quot;,
            &quot;slug&quot;: &quot;succubus&quot;
        },
        {
            &quot;id&quot;: 27,
            &quot;name&quot;: &quot;Suicide&quot;,
            &quot;slug&quot;: &quot;suicide&quot;
        },
        {
            &quot;id&quot;: 420,
            &quot;name&quot;: &quot;Sumata&quot;,
            &quot;slug&quot;: &quot;sumata&quot;
        },
        {
            &quot;id&quot;: 389,
            &quot;name&quot;: &quot;Sumo&quot;,
            &quot;slug&quot;: &quot;sumo&quot;
        },
        {
            &quot;id&quot;: 11,
            &quot;name&quot;: &quot;Super Power&quot;,
            &quot;slug&quot;: &quot;super-power&quot;
        },
        {
            &quot;id&quot;: 242,
            &quot;name&quot;: &quot;Super Robot&quot;,
            &quot;slug&quot;: &quot;super-robot&quot;
        },
        {
            &quot;id&quot;: 85,
            &quot;name&quot;: &quot;Superhero&quot;,
            &quot;slug&quot;: &quot;superhero&quot;
        },
        {
            &quot;id&quot;: 38,
            &quot;name&quot;: &quot;Supernatural&quot;,
            &quot;slug&quot;: &quot;supernatural&quot;
        },
        {
            &quot;id&quot;: 334,
            &quot;name&quot;: &quot;Surfing&quot;,
            &quot;slug&quot;: &quot;surfing&quot;
        },
        {
            &quot;id&quot;: 80,
            &quot;name&quot;: &quot;Surreal Comedy&quot;,
            &quot;slug&quot;: &quot;surreal-comedy&quot;
        },
        {
            &quot;id&quot;: 28,
            &quot;name&quot;: &quot;Survival&quot;,
            &quot;slug&quot;: &quot;survival&quot;
        },
        {
            &quot;id&quot;: 390,
            &quot;name&quot;: &quot;Sweat&quot;,
            &quot;slug&quot;: &quot;sweat&quot;
        },
        {
            &quot;id&quot;: 346,
            &quot;name&quot;: &quot;Swimming&quot;,
            &quot;slug&quot;: &quot;swimming&quot;
        },
        {
            &quot;id&quot;: 15,
            &quot;name&quot;: &quot;Swordplay&quot;,
            &quot;slug&quot;: &quot;swordplay&quot;
        },
        {
            &quot;id&quot;: 378,
            &quot;name&quot;: &quot;Table Tennis&quot;,
            &quot;slug&quot;: &quot;table-tennis&quot;
        },
        {
            &quot;id&quot;: 314,
            &quot;name&quot;: &quot;Tanks&quot;,
            &quot;slug&quot;: &quot;tanks&quot;
        },
        {
            &quot;id&quot;: 153,
            &quot;name&quot;: &quot;Tanned Skin&quot;,
            &quot;slug&quot;: &quot;tanned-skin&quot;
        },
        {
            &quot;id&quot;: 183,
            &quot;name&quot;: &quot;Teacher&quot;,
            &quot;slug&quot;: &quot;teacher&quot;
        },
        {
            &quot;id&quot;: 419,
            &quot;name&quot;: &quot;Teens&#039; Love&quot;,
            &quot;slug&quot;: &quot;teens-love&quot;
        },
        {
            &quot;id&quot;: 67,
            &quot;name&quot;: &quot;Tennis&quot;,
            &quot;slug&quot;: &quot;tennis&quot;
        },
        {
            &quot;id&quot;: 184,
            &quot;name&quot;: &quot;Tentacles&quot;,
            &quot;slug&quot;: &quot;tentacles&quot;
        },
        {
            &quot;id&quot;: 182,
            &quot;name&quot;: &quot;Terrorism&quot;,
            &quot;slug&quot;: &quot;terrorism&quot;
        },
        {
            &quot;id&quot;: 358,
            &quot;name&quot;: &quot;Threesome&quot;,
            &quot;slug&quot;: &quot;threesome&quot;
        },
        {
            &quot;id&quot;: 53,
            &quot;name&quot;: &quot;Thriller&quot;,
            &quot;slug&quot;: &quot;thriller&quot;
        },
        {
            &quot;id&quot;: 196,
            &quot;name&quot;: &quot;Time Loop&quot;,
            &quot;slug&quot;: &quot;time-loop&quot;
        },
        {
            &quot;id&quot;: 139,
            &quot;name&quot;: &quot;Time Manipulation&quot;,
            &quot;slug&quot;: &quot;time-manipulation&quot;
        },
        {
            &quot;id&quot;: 30,
            &quot;name&quot;: &quot;Time Skip&quot;,
            &quot;slug&quot;: &quot;time-skip&quot;
        },
        {
            &quot;id&quot;: 255,
            &quot;name&quot;: &quot;Tokusatsu&quot;,
            &quot;slug&quot;: &quot;tokusatsu&quot;
        },
        {
            &quot;id&quot;: 152,
            &quot;name&quot;: &quot;Tomboy&quot;,
            &quot;slug&quot;: &quot;tomboy&quot;
        },
        {
            &quot;id&quot;: 107,
            &quot;name&quot;: &quot;Torture&quot;,
            &quot;slug&quot;: &quot;torture&quot;
        },
        {
            &quot;id&quot;: 8,
            &quot;name&quot;: &quot;Tragedy&quot;,
            &quot;slug&quot;: &quot;tragedy&quot;
        },
        {
            &quot;id&quot;: 145,
            &quot;name&quot;: &quot;Trains&quot;,
            &quot;slug&quot;: &quot;trains&quot;
        },
        {
            &quot;id&quot;: 98,
            &quot;name&quot;: &quot;Transgender&quot;,
            &quot;slug&quot;: &quot;transgender&quot;
        },
        {
            &quot;id&quot;: 41,
            &quot;name&quot;: &quot;Travel&quot;,
            &quot;slug&quot;: &quot;travel&quot;
        },
        {
            &quot;id&quot;: 335,
            &quot;name&quot;: &quot;Triads&quot;,
            &quot;slug&quot;: &quot;triads&quot;
        },
        {
            &quot;id&quot;: 154,
            &quot;name&quot;: &quot;Tsundere&quot;,
            &quot;slug&quot;: &quot;tsundere&quot;
        },
        {
            &quot;id&quot;: 81,
            &quot;name&quot;: &quot;Twins&quot;,
            &quot;slug&quot;: &quot;twins&quot;
        },
        {
            &quot;id&quot;: 64,
            &quot;name&quot;: &quot;Unrequited Love&quot;,
            &quot;slug&quot;: &quot;unrequited-love&quot;
        },
        {
            &quot;id&quot;: 63,
            &quot;name&quot;: &quot;Urban&quot;,
            &quot;slug&quot;: &quot;urban&quot;
        },
        {
            &quot;id&quot;: 62,
            &quot;name&quot;: &quot;Urban Fantasy&quot;,
            &quot;slug&quot;: &quot;urban-fantasy&quot;
        },
        {
            &quot;id&quot;: 376,
            &quot;name&quot;: &quot;VTuber&quot;,
            &quot;slug&quot;: &quot;vtuber&quot;
        },
        {
            &quot;id&quot;: 40,
            &quot;name&quot;: &quot;Vampire&quot;,
            &quot;slug&quot;: &quot;vampire&quot;
        },
        {
            &quot;id&quot;: 428,
            &quot;name&quot;: &quot;Vertical Video&quot;,
            &quot;slug&quot;: &quot;vertical-video&quot;
        },
        {
            &quot;id&quot;: 391,
            &quot;name&quot;: &quot;Veterinarian&quot;,
            &quot;slug&quot;: &quot;veterinarian&quot;
        },
        {
            &quot;id&quot;: 97,
            &quot;name&quot;: &quot;Video Games&quot;,
            &quot;slug&quot;: &quot;video-games&quot;
        },
        {
            &quot;id&quot;: 233,
            &quot;name&quot;: &quot;Vikings&quot;,
            &quot;slug&quot;: &quot;vikings&quot;
        },
        {
            &quot;id&quot;: 240,
            &quot;name&quot;: &quot;Villainess&quot;,
            &quot;slug&quot;: &quot;villainess&quot;
        },
        {
            &quot;id&quot;: 245,
            &quot;name&quot;: &quot;Virginity&quot;,
            &quot;slug&quot;: &quot;virginity&quot;
        },
        {
            &quot;id&quot;: 90,
            &quot;name&quot;: &quot;Virtual World&quot;,
            &quot;slug&quot;: &quot;virtual-world&quot;
        },
        {
            &quot;id&quot;: 386,
            &quot;name&quot;: &quot;Vocal Synth&quot;,
            &quot;slug&quot;: &quot;vocal-synth&quot;
        },
        {
            &quot;id&quot;: 209,
            &quot;name&quot;: &quot;Volleyball&quot;,
            &quot;slug&quot;: &quot;volleyball&quot;
        },
        {
            &quot;id&quot;: 19,
            &quot;name&quot;: &quot;Vore&quot;,
            &quot;slug&quot;: &quot;vore&quot;
        },
        {
            &quot;id&quot;: 411,
            &quot;name&quot;: &quot;Voyeur&quot;,
            &quot;slug&quot;: &quot;voyeur&quot;
        },
        {
            &quot;id&quot;: 116,
            &quot;name&quot;: &quot;War&quot;,
            &quot;slug&quot;: &quot;war&quot;
        },
        {
            &quot;id&quot;: 371,
            &quot;name&quot;: &quot;Watersports&quot;,
            &quot;slug&quot;: &quot;watersports&quot;
        },
        {
            &quot;id&quot;: 340,
            &quot;name&quot;: &quot;Werewolf&quot;,
            &quot;slug&quot;: &quot;werewolf&quot;
        },
        {
            &quot;id&quot;: 291,
            &quot;name&quot;: &quot;Wilderness&quot;,
            &quot;slug&quot;: &quot;wilderness&quot;
        },
        {
            &quot;id&quot;: 197,
            &quot;name&quot;: &quot;Witch&quot;,
            &quot;slug&quot;: &quot;witch&quot;
        },
        {
            &quot;id&quot;: 231,
            &quot;name&quot;: &quot;Work&quot;,
            &quot;slug&quot;: &quot;work&quot;
        },
        {
            &quot;id&quot;: 333,
            &quot;name&quot;: &quot;Wrestling&quot;,
            &quot;slug&quot;: &quot;wrestling&quot;
        },
        {
            &quot;id&quot;: 230,
            &quot;name&quot;: &quot;Writing&quot;,
            &quot;slug&quot;: &quot;writing&quot;
        },
        {
            &quot;id&quot;: 263,
            &quot;name&quot;: &quot;Wuxia&quot;,
            &quot;slug&quot;: &quot;wuxia&quot;
        },
        {
            &quot;id&quot;: 212,
            &quot;name&quot;: &quot;Yakuza&quot;,
            &quot;slug&quot;: &quot;yakuza&quot;
        },
        {
            &quot;id&quot;: 65,
            &quot;name&quot;: &quot;Yandere&quot;,
            &quot;slug&quot;: &quot;yandere&quot;
        },
        {
            &quot;id&quot;: 71,
            &quot;name&quot;: &quot;Youkai&quot;,
            &quot;slug&quot;: &quot;youkai&quot;
        },
        {
            &quot;id&quot;: 36,
            &quot;name&quot;: &quot;Yuri&quot;,
            &quot;slug&quot;: &quot;yuri&quot;
        },
        {
            &quot;id&quot;: 142,
            &quot;name&quot;: &quot;Zombie&quot;,
            &quot;slug&quot;: &quot;zombie&quot;
        },
        {
            &quot;id&quot;: 427,
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
    --get "http://localhost/api/v1/public/anime/3" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/anime/3"
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
        &quot;id&quot;: 3,
        &quot;title&quot;: &quot;Death Note&quot;,
        &quot;slug&quot;: &quot;death-note-1535&quot;,
        &quot;description&quot;: &quot;Light Yagami is a genius high school student who is about to learn about life through a book of death. When a bored shinigami, a God of Death, named Ryuk drops a black notepad called a &lt;i&gt;Death Note&lt;/i&gt;, Light receives power over life and death with the stroke of a pen. Determined to use this dark gift for the best, Light sets out to rid the world of evil&hellip; namely, the people he believes to be evil. Should anyone hold such power?&lt;br&gt;\n&lt;br&gt;\nThe consequences of Light&rsquo;s actions will set the world ablaze.&lt;br&gt;\n&lt;br&gt;\n(Source: Viz Media)&quot;,
        &quot;poster_url&quot;: &quot;https://s4.anilist.co/file/anilistcdn/media/anime/cover/large/bx1535-kUgkcrfOrkUM.jpg&quot;,
        &quot;rating&quot;: &quot;8.40&quot;,
        &quot;year&quot;: 2006,
        &quot;status&quot;: &quot;finished&quot;,
        &quot;type&quot;: &quot;tv&quot;,
        &quot;number_of_episodes&quot;: 37,
        &quot;aired_from&quot;: null,
        &quot;aired_to&quot;: null,
        &quot;nsfw_flag&quot;: false,
        &quot;popularity&quot;: 850034,
        &quot;favorites&quot;: 45228,
        &quot;external_id&quot;: &quot;1535&quot;,
        &quot;external_source&quot;: &quot;anilist&quot;,
        &quot;tags&quot;: [
            {
                &quot;id&quot;: 4,
                &quot;name&quot;: &quot;Mystery&quot;,
                &quot;slug&quot;: &quot;mystery&quot;
            },
            {
                &quot;id&quot;: 8,
                &quot;name&quot;: &quot;Tragedy&quot;,
                &quot;slug&quot;: &quot;tragedy&quot;
            },
            {
                &quot;id&quot;: 12,
                &quot;name&quot;: &quot;Male Protagonist&quot;,
                &quot;slug&quot;: &quot;male-protagonist&quot;
            },
            {
                &quot;id&quot;: 16,
                &quot;name&quot;: &quot;Memory Manipulation&quot;,
                &quot;slug&quot;: &quot;memory-manipulation&quot;
            },
            {
                &quot;id&quot;: 22,
                &quot;name&quot;: &quot;Espionage&quot;,
                &quot;slug&quot;: &quot;espionage&quot;
            },
            {
                &quot;id&quot;: 24,
                &quot;name&quot;: &quot;Kuudere&quot;,
                &quot;slug&quot;: &quot;kuudere&quot;
            },
            {
                &quot;id&quot;: 25,
                &quot;name&quot;: &quot;Shounen&quot;,
                &quot;slug&quot;: &quot;shounen&quot;
            },
            {
                &quot;id&quot;: 27,
                &quot;name&quot;: &quot;Suicide&quot;,
                &quot;slug&quot;: &quot;suicide&quot;
            },
            {
                &quot;id&quot;: 30,
                &quot;name&quot;: &quot;Time Skip&quot;,
                &quot;slug&quot;: &quot;time-skip&quot;
            },
            {
                &quot;id&quot;: 31,
                &quot;name&quot;: &quot;Amnesia&quot;,
                &quot;slug&quot;: &quot;amnesia&quot;
            },
            {
                &quot;id&quot;: 34,
                &quot;name&quot;: &quot;Primarily Male Cast&quot;,
                &quot;slug&quot;: &quot;primarily-male-cast&quot;
            },
            {
                &quot;id&quot;: 38,
                &quot;name&quot;: &quot;Supernatural&quot;,
                &quot;slug&quot;: &quot;supernatural&quot;
            },
            {
                &quot;id&quot;: 52,
                &quot;name&quot;: &quot;Psychological&quot;,
                &quot;slug&quot;: &quot;psychological&quot;
            },
            {
                &quot;id&quot;: 53,
                &quot;name&quot;: &quot;Thriller&quot;,
                &quot;slug&quot;: &quot;thriller&quot;
            },
            {
                &quot;id&quot;: 54,
                &quot;name&quot;: &quot;Crime&quot;,
                &quot;slug&quot;: &quot;crime&quot;
            },
            {
                &quot;id&quot;: 55,
                &quot;name&quot;: &quot;Detective&quot;,
                &quot;slug&quot;: &quot;detective&quot;
            },
            {
                &quot;id&quot;: 56,
                &quot;name&quot;: &quot;Anti-Hero&quot;,
                &quot;slug&quot;: &quot;anti-hero&quot;
            },
            {
                &quot;id&quot;: 57,
                &quot;name&quot;: &quot;Police&quot;,
                &quot;slug&quot;: &quot;police&quot;
            },
            {
                &quot;id&quot;: 58,
                &quot;name&quot;: &quot;Fugitive&quot;,
                &quot;slug&quot;: &quot;fugitive&quot;
            },
            {
                &quot;id&quot;: 59,
                &quot;name&quot;: &quot;Philosophy&quot;,
                &quot;slug&quot;: &quot;philosophy&quot;
            },
            {
                &quot;id&quot;: 60,
                &quot;name&quot;: &quot;Primarily Adult Cast&quot;,
                &quot;slug&quot;: &quot;primarily-adult-cast&quot;
            },
            {
                &quot;id&quot;: 61,
                &quot;name&quot;: &quot;Gods&quot;,
                &quot;slug&quot;: &quot;gods&quot;
            },
            {
                &quot;id&quot;: 62,
                &quot;name&quot;: &quot;Urban Fantasy&quot;,
                &quot;slug&quot;: &quot;urban-fantasy&quot;
            },
            {
                &quot;id&quot;: 63,
                &quot;name&quot;: &quot;Urban&quot;,
                &quot;slug&quot;: &quot;urban&quot;
            },
            {
                &quot;id&quot;: 64,
                &quot;name&quot;: &quot;Unrequited Love&quot;,
                &quot;slug&quot;: &quot;unrequited-love&quot;
            },
            {
                &quot;id&quot;: 65,
                &quot;name&quot;: &quot;Yandere&quot;,
                &quot;slug&quot;: &quot;yandere&quot;
            },
            {
                &quot;id&quot;: 66,
                &quot;name&quot;: &quot;Acting&quot;,
                &quot;slug&quot;: &quot;acting&quot;
            },
            {
                &quot;id&quot;: 67,
                &quot;name&quot;: &quot;Tennis&quot;,
                &quot;slug&quot;: &quot;tennis&quot;
            },
            {
                &quot;id&quot;: 68,
                &quot;name&quot;: &quot;Assassins&quot;,
                &quot;slug&quot;: &quot;assassins&quot;
            },
            {
                &quot;id&quot;: 69,
                &quot;name&quot;: &quot;Achronological Order&quot;,
                &quot;slug&quot;: &quot;achronological-order&quot;
            },
            {
                &quot;id&quot;: 70,
                &quot;name&quot;: &quot;Asexual&quot;,
                &quot;slug&quot;: &quot;asexual&quot;
            }
        ],
        &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-anime--anime_id--comments">GET api/v1/public/anime/{anime_id}/comments</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime--anime_id--comments">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/public/anime/3/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/anime/3/comments"
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
        &quot;first&quot;: &quot;http://localhost/api/v1/public/anime/3/comments?page=1&quot;,
        &quot;last&quot;: &quot;http://localhost/api/v1/public/anime/3/comments?page=1&quot;,
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
                &quot;url&quot;: &quot;http://localhost/api/v1/public/anime/3/comments?page=1&quot;,
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
        &quot;path&quot;: &quot;http://localhost/api/v1/public/anime/3/comments&quot;,
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-anime--anime_id--episodes">GET api/v1/public/anime/{anime_id}/episodes</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime--anime_id--episodes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/public/anime/3/episodes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/anime/3/episodes"
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
    &quot;data&quot;: [
        {
            &quot;id&quot;: 550,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 1,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208036/30e0debac887bfa80643c54b25ba6e21/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 587,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 1,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590867/f538406cfb44788733c8d3982d35dc00/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 551,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 2,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208037/5de96ef6baa1818de67b24ac5ad430f7/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 588,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 2,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590868/adadae9de275bfc47a21b562a4dabaab/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 552,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 3,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208038/868f3db4f105c3e438ef2c48605c1467/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 589,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 3,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590869/052a9448ab69af2e0bc40d71eeef8313/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 553,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 4,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208039/b5dfd726b3e241bbc613db1a3401168e/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 590,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 4,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590870/b997779940b0a1638ff12d7fed513902/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 554,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 5,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208040/3a7d492a79540ac2381440e26a3845dd/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 591,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 5,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590871/638bc23c29bd0c8378e2aafa7a9755c3/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 555,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 6,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208041/3608b72dcf2adea303f121ccf9cec633/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 592,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 6,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590872/c5b0b189cb56cd4540f544975675493c/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 556,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 7,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208042/096d9df147613dee7fc8b885d9d7d200/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 593,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 7,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590873/63eb2f41534767448663c3e4dfc9e879/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 557,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 8,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208043/0f77ef594aad628410fcab6e96b95239/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 594,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 8,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590874/14342832a31cb8a7351085158d96d1f6/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 558,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 9,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208044/8cd08a43b0c41ef94e06244de1f5e283/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 595,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 9,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590875/05b6e4592bce0a58e31f56c3c0c8bf42/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 559,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 10,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208045/d1ee4f30fb4ead2acfc316b3a0ffb3e7/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 596,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 10,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590876/fce8c93e96c1f7c50f4cf8db71bfc0b7/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 560,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 11,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208046/3898037acf54d1354c46f1af450ad427/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 597,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 11,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590877/09ef3f4551e13903351c54eaf15c247e/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 561,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 12,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208047/0915ccf5d08928a05786b8a874a344c6/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 598,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 12,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590878/e4f2d19f92e70209eca2579dc9168ef1/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 562,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 13,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208048/947a2b1a3cbc9f53422554adc481ee0e/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 599,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 13,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590879/151c94f467134482200d33ea6657d8de/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 563,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 14,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208049/694d4202cfb859f5c6ab97d07f1f34df/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 600,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 14,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590880/704d1f477fe146694961d6c691c6a9b9/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 564,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 15,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208050/cc6dbda43b221626baa8c145b5bde66a/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 601,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 15,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590881/014ef9b62120c4c6b878be9c1b14d17b/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 565,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 16,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208051/a93813e4fce07a0a6c2ba91199894ab8/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 602,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 16,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590882/90160440c9cff4d67f40e7c2010261b5/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 566,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 17,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208052/f16fa55dc1464da73416d0fe38548e79/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 603,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 17,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590883/fa4abb4c4372596a1caaf02b8ec068b2/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 567,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 18,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208053/1aacd17f4b0e912e3927a542083021d2/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 604,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 18,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590884/ef50803243de37de0e8b2b20e8497d90/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 568,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 19,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208054/cc420dd347afbcccefe8f406e2224e00/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 605,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 19,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590885/06e5b181e8c0312d3022ea5fd1eed4c7/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 569,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 20,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208055/4079266127883cac7277685508e5f8ae/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 606,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 20,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590886/b2efd0613079bd6b1542dd21f4a17511/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 570,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 21,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208056/4358060cddf78544b04617fd7d62f0eb/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 607,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 21,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590887/e65eb6245a6bebee7067e76d6fb7f116/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 571,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 22,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208057/9b4d2d9803352128d56b21fac8f79179/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 608,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 22,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590888/b3a12f95833c52d9b847b6681801a634/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 572,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 23,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208058/6202d7133a8c2e0f1fdce464c063628b/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 609,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 23,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590889/05b2182ec69b07adc4a46ff75ee6e70e/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 573,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 24,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208059/1f43a7d4ea92c3184cc6985cd2ac5cbd/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 610,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 24,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590890/70fbbbaef5b26f4ca7f92ca903b96729/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 574,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 25,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208060/83d9439d427c92d6de2b926ee47ea24a/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 611,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 25,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590891/2b3cb76a1723263ce05b5adbcec44fce/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 575,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 26,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208061/24810adc19d24b9f219f83338101de1d/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 612,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 26,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590892/a85862897c3b062438e0860521788f87/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 576,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 27,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208062/8dea6f436f2f7953b008ed8a4f648dd0/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 613,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 27,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590893/7985dbb22e383ced8c47949c421507e6/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 577,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 28,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208063/98c2d42ba7eaa37fbdacd97c4268b7b4/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 614,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 28,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590894/a31978a66db0fbc3bdb8cc6f9e3113d0/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 578,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 29,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208064/967fc84b6936de977cc779428babca2f/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 615,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 29,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590895/cfc49d111374e34845c9fb09d8622013/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 579,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 30,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208065/3f3f67d8fef19f9f0a614d312761b5b8/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 616,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 30,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590896/ebbfe545e7a7d6182e8cc8b9ec3c3cdd/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 580,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 31,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208066/88051591c5af4cb3c5c5b967dc3d8825/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 617,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 31,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590897/a8b0007936e86ef82a1885abd2a7526e/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 581,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 32,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208067/7e8b133824a79956608a4581302ae0fb/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 618,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 32,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590898/0706534ee57491db528824bb8e3fdebd/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 582,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 33,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208068/854c4065dd7f5e267db0931354d0acd7/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 619,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 33,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590899/44fd7e7641f07d1cb2fba62f5252c085/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 583,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 34,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208069/d6099d9a0390568d28b249e800451c16/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 620,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 34,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590900/cc4e9b1f122acd2aed7070dce440835c/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 584,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 35,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208070/8ffa0ae59d8aa995a34b39a9116fafa6/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 621,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 35,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590901/bbfbd35672089b0a4b7ed5216cd100bd/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 585,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 36,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208071/bf76fd413f5cb9c7727289d40334d6c4/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 622,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 36,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590902/6bb9ef1e4cd3281f7bde05e9be7d8b32/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 586,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 37,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/208072/e2970426fa44a00fb6f10434ccd3e3fa/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;Мега-Аниме&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        },
        {
            &quot;id&quot;: 623,
            &quot;anime_id&quot;: 3,
            &quot;episode_number&quot;: 37,
            &quot;season_number&quot;: 1,
            &quot;title&quot;: null,
            &quot;player_url&quot;: &quot;https://kodik.info/seria/590903/a75bb49d404dbb46dc81d90f75ea8b17/720p&quot;,
            &quot;player_iframe&quot;: null,
            &quot;translator&quot;: &quot;СВ-Дубль&quot;,
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
            &quot;created_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2026-01-01T17:31:38.000000Z&quot;
        }
    ]
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-anime--anime_id--community-stats">GET api/v1/public/anime/{anime_id}/community-stats</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-anime--anime_id--community-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/public/anime/3/community-stats" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/anime/3/community-stats"
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
    &quot;watching&quot;: 1,
    &quot;planned&quot;: 0,
    &quot;completed&quot;: 0,
    &quot;on_hold&quot;: 0,
    &quot;dropped&quot;: 0,
    &quot;total&quot;: 1
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
               value="3"
               data-component="url">
    <br>
<p>The ID of the anime. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-public-episodes--episode-">GET api/v1/public/episodes/{episode}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-public-episodes--episode-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/public/episodes/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/episodes/1"
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
    &quot;anime_id&quot;: 1,
    &quot;episode_number&quot;: 1,
    &quot;season_number&quot;: 0,
    &quot;title&quot;: null,
    &quot;player_url&quot;: &quot;https://kodik.info/seria/613600/3ad66e72dab862fa1e3d06416bc8eac6/720p&quot;,
    &quot;player_iframe&quot;: null,
    &quot;translator&quot;: &quot;Animedia&quot;,
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
    &quot;created_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2026-01-01T17:31:37.000000Z&quot;
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
    --get "http://localhost/api/v1/public/episodes/1/player" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/episodes/1/player"
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
    &quot;player_url&quot;: &quot;https://kodik.info/seria/613600/3ad66e72dab862fa1e3d06416bc8eac6/720p&quot;,
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
    --get "http://localhost/api/v1/public/users/2/statistics" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/public/users/2/statistics"
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
    "http://localhost/api/v1/auth/register" \
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
    "http://localhost/api/v1/auth/register"
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
    "http://localhost/api/v1/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"gbailey@example.net\",
    \"password\": \"|]|{+-\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/login"
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
    --get "http://localhost/api/v1/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user"
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
    "http://localhost/api/v1/auth/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/logout"
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
    --get "http://localhost/api/v1/my-comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/my-comments"
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
    "http://localhost/api/v1/comments" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"anime_id\": 16,
    \"comment\": \"n\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/comments"
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
    "http://localhost/api/v1/comments/4" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"comment\": \"b\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/comments/4"
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
               value="4"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>4</code></p>
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
    "http://localhost/api/v1/comments/4" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/comments/4"
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
               value="4"
               data-component="url">
    <br>
<p>The ID of the comment. Example: <code>4</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-profile-me">GET api/v1/profile/me</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-profile-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/profile/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/profile/me"
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
    "http://localhost/api/v1/profile/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"custom_status\": \"g\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/profile/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
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
    "http://localhost/api/v1/profile/me/avatar" \
    --header "Content-Type: multipart/form-data" \
    --header "Accept: application/json" \
    --form "avatar=@/tmp/phpsZyoAv" </code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/profile/me/avatar"
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
<p>Must be an image. Must not be greater than 2048 kilobytes. Example: <code>/tmp/phpsZyoAv</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-v1-statistics-me">GET api/v1/statistics/me</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-statistics-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/statistics/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/statistics/me"
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
    --get "http://localhost/api/v1/statistics/me/episodes-summary" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/statistics/me/episodes-summary"
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
    "http://localhost/api/v1/anime/3/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"not_watching\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/anime/3/status"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "not_watching"
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
               value="3"
               data-component="url">
    <br>
<p>The anime. Example: <code>3</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="POSTapi-v1-anime--anime--status"
               value="not_watching"
               data-component="body">
    <br>
<p>Example: <code>not_watching</code></p>
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
    --get "http://localhost/api/v1/anime/3/user-status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/anime/3/user-status"
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
               value="3"
               data-component="url">
    <br>
<p>The anime. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">PATCH api/v1/anime/{anime}/episodes-watched/{episodesWatched}</h2>

<p>
</p>



<span id="example-requests-PATCHapi-v1-anime--anime--episodes-watched--episodesWatched-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/v1/anime/3/episodes-watched/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/anime/3/episodes-watched/architecto"
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
               value="3"
               data-component="url">
    <br>
<p>The anime. Example: <code>3</code></p>
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
    --get "http://localhost/api/v1/my-anime-list/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/my-anime-list/architecto"
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
    --get "http://localhost/api/v1/favorites" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/favorites"
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
    "http://localhost/api/v1/favorites" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"anime_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/favorites"
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
    "http://localhost/api/v1/favorites/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/favorites/architecto"
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
    --get "http://localhost/api/v1/favorites/architecto/check" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/favorites/architecto/check"
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
    --get "http://localhost/api/v1/watch-history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/watch-history"
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
    "http://localhost/api/v1/watch-history" \
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
    "http://localhost/api/v1/watch-history"
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
    --get "http://localhost/api/v1/watch-history/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/watch-history/architecto"
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
    "http://localhost/api/v1/watch-history/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/watch-history/architecto"
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
    --get "http://localhost/api/v1/watch-history/anime/3/history" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/watch-history/anime/3/history"
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
               value="3"
               data-component="url">
    <br>
<p>Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-watch-history-anime--animeId--last-episode">GET api/v1/watch-history/anime/{animeId}/last-episode</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-watch-history-anime--animeId--last-episode">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/watch-history/anime/3/last-episode" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/watch-history/anime/3/last-episode"
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
               value="3"
               data-component="url">
    <br>
<p>Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-ratings">GET api/v1/ratings</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-ratings">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/ratings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/ratings"
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
    "http://localhost/api/v1/ratings" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"anime_id\": 16,
    \"rating\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/ratings"
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
    "http://localhost/api/v1/ratings/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/ratings/2"
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
               value="2"
               data-component="url">
    <br>
<p>The ID of the rating. Example: <code>2</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-ratings-anime--animeId-">GET api/v1/ratings/anime/{animeId}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-ratings-anime--animeId-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/ratings/anime/3" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/ratings/anime/3"
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
               value="3"
               data-component="url">
    <br>
<p>Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-GETapi-v1-anime-list--status--">GET api/v1/anime-list/{status?}</h2>

<p>
</p>



<span id="example-requests-GETapi-v1-anime-list--status--">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/v1/anime-list/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/anime-list/architecto"
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
    --get "http://localhost/api/v1/anime-list/anime/3/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/anime-list/anime/3/status"
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
               value="3"
               data-component="url">
    <br>
<p>The anime. Example: <code>3</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-PUTapi-v1-anime-list-anime--anime--status">PUT api/v1/anime-list/anime/{anime}/status</h2>

<p>
</p>



<span id="example-requests-PUTapi-v1-anime-list-anime--anime--status">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/v1/anime-list/anime/3/status" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"status\": \"dropped\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/anime-list/anime/3/status"
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
               value="3"
               data-component="url">
    <br>
<p>The anime. Example: <code>3</code></p>
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
    "http://localhost/api/v1/anime-list/anime/3/watched" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/anime-list/anime/3/watched"
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
               value="3"
               data-component="url">
    <br>
<p>The anime. Example: <code>3</code></p>
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
