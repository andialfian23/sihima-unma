<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGNATURE TEST</title>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@500&family=Jost&family=Pattaya&family=Playfair+Display&family=Great+Vibes&family=Roboto&display=swap" rel="stylesheet" />

    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url('signature/') ?>css/view.css" /> -->
    <style>
        /**** Form Section ****/
        .appnitro {
            font-family: "Lucida Grande", Tahoma, Arial, Verdana, sans-serif;
            font-size: small;
            width: 50%;
        }

        #main_body form ul {
            font-size: 100%;
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #main_body form li {
            display: block;
            margin: 0;
            padding: 4px 5px 2px 9px;
            position: relative;
            clear: both;
        }

        #main_body form li:after {
            clear: both;
            content: ".";
            display: block;
            height: 0;
            visibility: hidden;
        }


        #main_body form li label.description,
        #main_body form li span.description {
            border: none;
            color: #444;
            display: block;
            font-size: 95%;
            font-weight: 700;
            line-height: 150%;
            padding: 0 0 1px;
            float: none;
        }

        .mf_signature_wrapper {
            border-radius: 5px;
            border: 2px solid #ccc;
            padding-bottom: 0px !important;
        }

        .mf_signature_clear {
            float: right;
            margin-right: 5px;
            margin-top: 5px;
            display: block;
        }

        .mf_signature_switch a {
            text-decoration: none;
            border-bottom: 1px dotted #3B699F;
            font-family: Arial, Verdana, Helvetica;
        }

        .mf_signature_switch a:visited {
            color: #3661A1;
        }

        .mf_signature_switch a.active {
            text-decoration: none;
            border-bottom: none;
            background-color: #6d6d6d;
            border-radius: 3px;
            padding: 5px;
            color: #fff;
        }
    </style>

    <script type="text/javascript" src="<?= base_url('signature/') ?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url('signature/') ?>js/my.js"></script>
    <script type="text/javascript" src="<?= base_url('signature/') ?>js/signature_pad.umd.js"></script>
</head>

<body id="main_body">

    <form class="appnitro" method="post" action="#">
        <ul>
            <li id="li_14" class="signature">
                <label class="description" for="element_14">Tanda Tangan pada kotak dibawah ini </label>
                <div id="mf_signature_pad_14">
                    <div class="mf_signature_switch" style="text-align: right">
                        <a class="sig_switch_draw active" href="javascript: switch_signature_type(14,'draw');">Draw</a> or
                        <a class="sig_switch_type " href="javascript: switch_signature_type(14,'type');">Type</a>
                    </div>

                    <div class="mf_signature_draw" style="display: block">
                        <div class="mf_signature_wrapper medium" style="height: 150px">
                            <canvas id="mf_canvas_signature_pad_14" class="mf_canvas_signature_pad" style="width: 100%; height: 100%"></canvas>
                        </div>
                        <span class="label">I understand this is a legal representation of my signature.</span>
                        <a class="mf_signature_clear element_14_clear" href="javascript:clear_signature(14)">Clear</a>
                    </div>

                    <div class="mf_signature_type" style="display: none">
                        <!-- <input id="element_14_text_signature" name="element_14_text_signature" data-elementid="14" class="element text large text_signature" type="text" value="" /> -->
                        <input id="element_14_text_signature" name="element_14_text_signature" class="element text large text_signature" type="text" value="" />

                        <div class="mf_signature_wrapper medium" style="height: 100px;margin-top: 20px">
                            <img id="element_14_text_signature_img" style="height: 75px;margin-top: 10px;margin-left: 15px;" />
                        </div>
                        <!-- <div class="image-wrapper"></div> -->
                        <span class="label">I understand this is a legal representation of my signature.</span>
                    </div>

                    <input type="hidden" name="element_14" id="element_14" value="">
                </div>
            </li>
            <li class="buttons">
                <input id="submit_form" class="button_text" type="submit" name="submit_form" value="Submit" />
            </li>
        </ul>
    </form>

    <script type="text/javascript">
        var canvas_14 = document.getElementById('mf_canvas_signature_pad_14');
        var signature_pad_14 = new SignaturePad(canvas_14);
        signature_pad_14.onEnd = function() {
            $("#element_" + 14).val(signature_pad_14.toDataURL());
        };
        refresh_signature(signature_pad_14, canvas_14);

        var imageElem = document.getElementById('element_14_text_signature_img'); //Image element

        const dpr = window.devicePixelRatio || 1;
        async function generateImage() {
            const text = document.getElementById("element_14_text_signature").value;
            const text2 = document.getElementById("element_14_text_signature").value;
            const font = 'Pattaya';
            if (!text) {
                return;
            }
            const imageBlob = await textToBitmap(text, font);
            const imageUrl = URL.createObjectURL(imageBlob);

            // const imageWrapper = document.getElementById("image-wrapper");
            const image = new Image();
            // image.src = imageUrl;
            // imageWrapper.replaceChildren(image);

            imageElem.src = imageUrl;
            // console.log(imageUrl);
            console.log(imageElem.src);
            imageElem.replaceChildren(image);
            requestAnimationFrame(() => {
                const currentHeight = image.getBoundingClientRect().height;
                image.style.height = `${currentHeight / dpr}px`;
            }, 0);
        }

        async function textToBitmap(text, font) {
            let canvas;
            let convertToBlob;
            const FONT_SIZE = 100;
            const VERTICAL_EXTRA_SPACE = 5;
            const HORIZONTAL_EXTRA_SPACE = 2;

            if ("OffscreenCanvas" in window) {
                canvas = new window.OffscreenCanvas(200, 200);
                convertToBlob = canvas.convertToBlob.bind(canvas);
            } else {
                canvas = window.document.createElement("canvas");
                convertToBlob = () =>
                    new Promise((resolve) => {
                        if (canvas.msToBlob && !canvas.toBlob) {
                            const blob = canvas.msToBlob();
                            resolve(blob);
                        } else {
                            canvas.toBlob(resolve);
                        }
                    });
            }
            const ctx = canvas.getContext("2d", {
                willReadFrequently: true
            });
            ctx.textBaseline = "top";
            ctx.font = `${FONT_SIZE * dpr}px "${font}"`;
            const {
                actualBoundingBoxLeft,
                actualBoundingBoxRight,
                fontBoundingBoxAscent,
                fontBoundingBoxDescent,
                actualBoundingBoxAscent,
                actualBoundingBoxDescent,
                width
            } = ctx.measureText(text);
            const canvasHeight =
                Math.max(
                    Math.abs(actualBoundingBoxAscent) + Math.abs(actualBoundingBoxDescent),
                    (Math.abs(fontBoundingBoxAscent) || 0) +
                    (Math.abs(fontBoundingBoxDescent) || 0)
                ) * VERTICAL_EXTRA_SPACE;
            canvas.height = canvasHeight;
            const canvasWidth =
                Math.max(width, Math.abs(actualBoundingBoxLeft) + actualBoundingBoxRight) *
                HORIZONTAL_EXTRA_SPACE;
            canvas.width = canvasWidth;
            ctx.textBaseline = "top";
            ctx.font = `${FONT_SIZE * dpr}px "${font}"`;
            ctx.fillText(text, canvasWidth / 4, canvasHeight / 4);
            trimCanvas(canvas);
            return convertToBlob({
                type: "image/png"
            });
        }

        function trimCanvas(canvas) {
            const ctx = canvas.getContext("2d", {
                willReadFrequently: true
            });
            const pixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const length = pixels.data.length;
            let topCoord = null;
            let bottomCoord = null;
            let leftCoord = null;
            let rightCoord = null;
            let x = 0;
            let y = 0;
            for (let i = 0; i < length; i += 4) {
                if (pixels.data[i + 3] !== 0) {
                    x = (i / 4) % canvas.width;
                    y = Math.trunc(i / 4 / canvas.width);
                    if (topCoord === null) {
                        topCoord = y;
                    }
                    if (leftCoord === null || x < leftCoord) {
                        leftCoord = x;
                    }
                    if (rightCoord === null || x > rightCoord) {
                        rightCoord = x;
                    }
                    if (bottomCoord === null || bottomCoord < y) {
                        bottomCoord = y;
                    }
                }
            }
            topCoord = topCoord || 0;
            bottomCoord = bottomCoord || 0;
            leftCoord = leftCoord || 0;
            rightCoord = rightCoord || 0;
            const trimHeight = bottomCoord - topCoord + 20;
            const trimWidth = rightCoord - leftCoord + 20;
            const trimmed = ctx.getImageData(leftCoord, topCoord, trimWidth, trimHeight);

            canvas.width = trimWidth;
            canvas.height = trimHeight;
            ctx.putImageData(trimmed, 10, 10);
        }
        document.getElementById('element_14_text_signature').addEventListener('keyup', async () => {
            await generateImage();
        });
    </script>

</body>

</html>