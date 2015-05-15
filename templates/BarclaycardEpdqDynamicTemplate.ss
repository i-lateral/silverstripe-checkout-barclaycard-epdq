<!DOCTYPE html>

<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->

    <head>
        <title>$MetaTitle</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <style type="text/css">
            /* Reset */
            html, body, div, span, object, iframe,
            h1, h2, h3, h4, h5, h6, p, blockquote, pre,
            abbr, address, cite, code, del, dfn, em, img, ins, kbd, q, samp,
            small, strong, sub, sup, var, b, i, dl, dt, dd, ol, ul, li,
            fieldset, form, label, legend,
            table, caption, tbody, tfoot, thead, tr, th, td,
            article, aside, canvas, details, figcaption, figure,
            footer, header, hgroup, menu, nav, section, summary,
            time, mark, audio, video{margin:0; padding:0; border:0; font-size:100%; font:inherit; vertical-align:baseline;}

            article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section{display: block;}

            html{overflow-y:scroll;}
            body{-webkit-text-size-adjust:none;}

            .clear:before, .clear:after {content: "\0020"; display: block; height: 0; overflow: hidden; }
            .clear:after {clear:both;}
            .clear{zoom:1;}

            sub, sup{font-size:75%; line-height:0; position:relative;}
            sup{top:-0.5em;}
            sub{bottom:-0.25em;}

            pre {white-space:pre; white-space:pre-wrap; word-wrap:break-word; padding:15px;}
            textarea {overflow:auto;}
            .ie6 legend, .ie7 legend {margin-left:-7px;} 
            input[type="radio"], input.radio {vertical-align:text-bottom;}
            input[type="checkbox"], input.checkbox, .checkboxes input {vertical-align:bottom;}
            .ie7 input[type="checkbox"], .ie7 input.checkbox, .ie7 .checkboxes input {vertical-align:baseline;}
            .ie6 input {vertical-align: text-bottom;}
            label, input[type="button"], input[type="submit"], input[type="image"], button, .btn {cursor:pointer;}
            button, input, select, textarea {margin:0;}
            /* .checkbox, .radio {float:left; width:13px; height:13px; margin-right:6px; padding:0;} */

            button {width:auto; overflow:visible;}
            .ie7 img {-ms-interpolation-mode: bicubic;}

            .ir {display:block; text-indent:-999em; overflow:hidden; background-repeat:no-repeat; text-align:left; direction:ltr; }
            .hidden {display:none; visibility:hidden; }
            .visuallyhidden {border:0; clip:rect(0 0 0 0); height:1px; margin:-1px; overflow:hidden; padding:0; position:absolute; width:1px; }
            .visuallyhidden.focusable:active,
            .visuallyhidden.focusable:focus {clip:auto; height:auto; margin:0; overflow:visible; position:static; width:auto;}
            .invisible {visibility:hidden;}

            blockquote, q {quotes:none;}
            blockquote:before, blockquote:after, q:before, q:after {content: ''; content:none;}
            ins {background-color:#ff9; color:#000; text-decoration:none;}
            mark {background-color:#ff9; color:#000; font-style:italic; font-weight:bold;}
            del {text-decoration: line-through; }
            abbr[title], dfn[title] {border-bottom:1px dotted; cursor:help;}
            hr {display:block; height:1px; border:0; border-top:1px solid #ccc; margin:1em 0; padding:0;}
            input, select {vertical-align:middle;}

            a:hover, a:active {outline: none;}
            .content ul, .content ol {margin-left:2em;}
            ol {list-style-type:decimal;}
            ul li {list-style-type:none;}
            nav ul, nav li {margin:0; list-style:none; list-style-image:none;}
            strong, b, th {font-weight:bold;}
            body {
                font-size: 13px;
                line-height: 20px;
                margin-bottom: 20px;
                font-family: Arial, Helvetica, sans-serif;
            }
            /* HEADERS */
            h1, h2, h3, h4, h5, h6 {
                font-weight: normal;
                margin-bottom: 0.5em;
            }
            h1 { font-size: 1.75em; }
            h2 { font-size: 1.5em; }
            h3 { font-size: 1.3em; }
            h4 { font-size: 1.1em; }
            h5 { font-size: 0.9em; }
            h6 { font-size: 0.9em; }
            
            .wrapper {
                margin: auto;
                max-width: 700px;
                padding: 1em;
            }
            
            .header {
                margin: 1em 0;
                border-bottom: 2px solid #ededed;
            }
            
            .main {
                margin: 1em 0;
            }
            
            .footer {
                background: #ededed;
                display: block;
                height: 50px;
            }
        </style>
    </head>

    <body>

        <div class="wrapper">
            <header class="header clearfix">
                <div class="inner clearfix">
                    <div class="brand">
                        <h1>$SiteConfig.Title</h1>

                        <% if $SiteConfig.Tagline %>
                            <p class="title">$Title</p>
                        <% end_if %>
                    </div>
                </div>
            </header>

            <div class="main">
                <div class="inner">
                    $$$PAYMENT ZONE$$$
                </div>
            </div>

            <footer class="footer clearfix">
                <div class="inner"></div>
            </footer>
        </div>
    </body>
</html>
