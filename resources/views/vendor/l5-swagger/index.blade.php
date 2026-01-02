<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $documentationTitle }} | AniYume API</title>
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        html { box-sizing: border-box; }
        *, *:before, *:after { box-sizing: inherit; }

        body {
            margin: 0;
            background: #0A0A0A !important;
            font-family: 'Inter', sans-serif !important;
        }

        .swagger-ui {
            filter: invert(0) !important;
            background-color: #0A0A0A !important;
        }

        .swagger-ui .topbar {
            background-color: #111111 !important;
            border-bottom: 1px solid rgba(46, 196, 182, 0.2) !important;
            padding: 15px 0 !important;
        }

        .swagger-ui .info .title {
            color: #FFFFFF !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            letter-spacing: -0.05em !important;
            font-style: italic !important;
        }

        .swagger-ui .info .title span {
            display: none;
        }

        .swagger-ui .info .title::after {
            content: ' API';
            color: #2EC4B6;
        }

        .swagger-ui .info p, .swagger-ui .info li, .swagger-ui .info td {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 14px !important;
        }

        .swagger-ui .scheme-container {
            background: #0A0A0A !important;
            box-shadow: none !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
            padding: 20px 0 !important;
        }

        .swagger-ui select {
            background: #161616 !important;
            color: #FFFFFF !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
        }

        .swagger-ui .opblock-tag {
            color: #FFFFFF !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.1em !important;
            border-bottom: 1px solid rgba(46, 196, 182, 0.3) !important;
        }

        .swagger-ui .opblock {
            background: #111111 !important;
            border-radius: 12px !important;
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
            margin-bottom: 15px !important;
        }

        .swagger-ui .opblock .opblock-summary-path {
            color: #FFFFFF !important;
            font-weight: 700 !important;
            font-family: 'Inter', sans-serif !important;
        }

        .swagger-ui .opblock .opblock-summary-method {
            border-radius: 8px !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            padding: 6px 15px !important;
        }

        .swagger-ui .opblock.opblock-get { border-color: #2EC4B6 !important; background: rgba(46, 196, 182, 0.05) !important; }
        .swagger-ui .opblock.opblock-get .opblock-summary-method { background: #2EC4B6 !important; color: #000 !important; }

        .swagger-ui .opblock.opblock-post { border-color: #49cc90 !important; background: rgba(73, 204, 144, 0.05) !important; }
        .swagger-ui .opblock.opblock-post .opblock-summary-method { background: #49cc90 !important; color: #000 !important; }

        .swagger-ui .opblock.opblock-delete { border-color: #ff4d4d !important; background: rgba(255, 77, 77, 0.05) !important; }
        .swagger-ui .opblock.opblock-delete .opblock-summary-method { background: #ff4d4d !important; color: #fff !important; }

        .swagger-ui .btn.authorize {
            background-color: #2EC4B6 !important;
            color: #000 !important;
            border: none !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            border-radius: 10px !important;
            box-shadow: 0 0 15px rgba(46, 196, 182, 0.3) !important;
        }

        .swagger-ui .btn.authorize svg { fill: #000 !important; }

        .swagger-ui .btn.execute {
            background-color: #2EC4B6 !important;
            color: #000 !important;
            border: none !important;
            font-weight: 900 !important;
            width: 100% !important;
            padding: 12px !important;
            border-radius: 12px !important;
        }

        .swagger-ui input[type=text], .swagger-ui textarea {
            background: #161616 !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #FFFFFF !important;
            border-radius: 8px !important;
            padding: 10px !important;
        }

        .swagger-ui .opblock-description-wrapper h4, 
        .swagger-ui .opblock-title_normal, 
        .swagger-ui .response-col_status, 
        .swagger-ui .response-col_links,
        .swagger-ui .parameter__name,
        .swagger-ui .parameter__type,
        .swagger-ui .model-title {
            color: #FFFFFF !important;
            font-weight: 700 !important;
        }

        .swagger-ui table thead tr th {
            color: rgba(255, 255, 255, 0.4) !important;
            text-transform: uppercase !important;
            font-size: 11px !important;
            letter-spacing: 0.1em !important;
            border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        }

        .swagger-ui .model-box {
            background: #161616 !important;
            border-radius: 10px !important;
            padding: 15px !important;
        }

        .swagger-ui section.models {
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            border-radius: 15px !important;
            background: #111111 !important;
        }

        .swagger-ui section.models h4 {
            color: #FFFFFF !important;
            text-transform: uppercase !important;
            font-weight: 900 !important;
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0A0A0A; }
        ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #2EC4B6; }

        .swagger-ui .filter .operation-filter-input {
            background: #111111 !important;
            border: 1px solid rgba(46, 196, 182, 0.2) !important;
            color: #FFFFFF !important;
            border-radius: 10px !important;
            padding: 12px 20px !important;
        }
    </style>
</head>

<body>
<div id="swagger-ui"></div>

<script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
<script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
<script>
    window.onload = function() {
        const urls = [];
        @foreach($urlsToDocs as $title => $url)
            urls.push({name: "{{ $title }}", url: "{{ $url }}"});
        @endforeach

        const ui = SwaggerUIBundle({
            dom_id: '#swagger-ui',
            urls: urls,
            "urls.primaryName": "{{ $documentationTitle }}",
            operationsSorter: {!! isset($operationsSorter) ? '"' . $operationsSorter . '"' : 'null' !!},
            configUrl: {!! isset($configUrl) ? '"' . $configUrl . '"' : 'null' !!},
            validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
            oauth2RedirectUrl: "{{ route('l5-swagger.'.$documentation.'.oauth2_callback', [], $useAbsolutePath) }}",

            requestInterceptor: function(request) {
                request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
                return request;
            },

            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],

            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],

            layout: "StandaloneLayout",
            docExpansion : "{!! config('l5-swagger.defaults.ui.display.doc_expansion', 'none') !!}",
            deepLinking: true,
            filter: {!! config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' !!},
            persistAuthorization: "{!! config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' !!}",
        })

        window.ui = ui

        @if(in_array('oauth2', array_column(config('l5-swagger.defaults.securityDefinitions.securitySchemes'), 'type')))
        ui.initOAuth({
            usePkceWithAuthorizationCodeGrant: "{!! (bool)config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant') !!}"
        })
        @endif
    }
</script>
</body>
</html>