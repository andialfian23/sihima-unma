<script>
    var notifError = document.getElementById('errorPresensi');
    var responseText = document.getElementById('responseText');

    var saveButton = document.getElementById("submit_form");
    var canvas_14 = document.getElementById('mf_canvas_signature_pad_14');
    var inputName = document.getElementById('input_name');
    var signature_pad_14 = new SignaturePad(canvas_14);
    signature_pad_14.onEnd = function() {
        $("#element_14").val(signature_pad_14.toDataURL());
        console.log(signature_pad_14.toDataURL());
    };
    refresh_signature(signature_pad_14, canvas_14);

    var imageElem = document.getElementById('element_14_text_signature_img'); //Image element
    const dpr = window.devicePixelRatio || 1;
    async function generateImage() {
        const text_input = document.getElementById("input_name").value;
        const font = 'Pattaya';
        if (!text_input) {
            return;
        }
        const imageBlob = await textToBitmap(text_input, font);
        const imageUrl = URL.createObjectURL(imageBlob);

        // console.log(imageBlob);
        // console.log(imageUrl);                                    
        // const

        const base64String = await convertBlobToBase64(imageBlob);
        $("#element_14").val(base64String);
        // console.log(base64String);

        const image = new Image();
        image.src = imageUrl;
        imageElem.src = imageUrl;
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
    convertBlobToBase64 = (blob) => new Promise((resolve, reject) => {
        console.log(blob);
        const reader = new FileReader;
        reader.onerror = reject;
        reader.onload = () => {
            resolve(reader.result);
        };
        reader.readAsDataURL(blob);
    });

    inputName.addEventListener('keyup', async () => {
        var notif = document.getElementById('notif');
        if (inputName.value.length > 8) {
            notif.innerHTML = 'Panjang Input Maksimal 8 Karakter!';
            inputName.focus();
            return false;
        } else {
            notif.innerHTML = '';
            await generateImage();
            return true;
        }
    });


    saveButton.addEventListener("click", function(event) {
        var ttd = $('#element_14').val();
        if (ttd == '') {
            $('#myModal').modal('show');
            setTimeout(function() {
                window.location.replace("<?= base_url('presensi/online/' . $token) ?>");
            }, 2000);
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>presensi/proses_presensi",
                data: {
                    'ttd': ttd,
                    'token_presensi': $('#token_presensi').val()
                },
                success: function(d) {
                    console.log(d);
                    if (d == "Presensi Berhasil") {
                        $('#myModal2').modal('show');
                    } else {
                        // alert(d);
                        notifError.classList.remove('d-none');
                        responseText.innerHTML = d;
                    }
                    setTimeout(function() {
                        window.location.replace("<?= base_url('presensi/online/' . $token) ?>");
                    }, 2000);
                },
                failed: function() {
                    alert('GAGAL PRESENSI');
                }
            });
        }
    });
</script>