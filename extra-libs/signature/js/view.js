$(function() {
	if ($("#main_body div.file_queue").length > 0) {
		$('form.appnitro').submit(function() {
			if ($("form.appnitro").data('form_submitting') !== true) {

				$("#li_buttons > input[type=submit],#li_buttons > input[type=image]").prop("disabled", true);
				$("form.appnitro").data('form_submitting', true);
				if (is_support_html5_uploader()) {
					$("#main_body input.file").uploadifive('upload');
					if ($("#main_body div.uploadifive-queue-item").not('.complete').not('.error').length < 1) {
						$('form.appnitro').submit();
					}
				}
				return false;
			} else {
				return true;
			}
		});

	} else {
		$('form.appnitro').submit(function() {
			$("#li_buttons > input[type=submit],#li_buttons > input[type=image]").prop("disabled", true);
		});
	}
	//primary and secondary buttons are being disabled upon submit
	//thus we need to attach additional handler to send the clicked button as hidden variable
	$("#submit_secondary,#submit_img_secondary").click(function() {
		$("#li_buttons").append('<input type="hidden" name="submit_secondary" value="1" />');
	});

	$("#submit_primary,#submit_img_primary").click(function() {
		$("#li_buttons").append('<input type="hidden" name="submit_primary" value="1" />');
	});
	//attach event handler to signature fields, to draw the signature images when the user type the full name
	$("form.appnitro li.signature input.text_signature").on('keyup', function() {
		var element_id = $(this).data("elementid");
		var signature_text = $(this).val();

		$("#element_14").val(signature_text);
		// $("#element_" + element_id + "_text_signature_img").attr("src","signature_img_renderer.php?signature_text=" + signature_text);
	});
});
//adjust canvas coordinate space taking into account pixel ratio, to make it look crisp on mobile devices
function refresh_signature(signature_pad, signature_canvas) {
	var ratio = Math.max(window.devicePixelRatio || 1, 1);
	// This part causes the canvas to be cleared
	signature_canvas.width = signature_canvas.offsetWidth * ratio;
	signature_canvas.height = signature_canvas.offsetHeight * ratio;
	signature_canvas.getContext("2d").scale(ratio, ratio);
	signature_pad.clear();
}
//clear the signature canvas
function clear_signature(element_id) {
	var canvas = document.getElementById('mf_canvas_signature_pad_' + element_id);
	var signature_pad = new SignaturePad(canvas);
	signature_pad.clear();
	$("#element_" + element_id).val('');
}
//show/hide the draw/type signature content
function switch_signature_type(element_id, signature_type) {
	$("#li_" + element_id + " .mf_signature_draw").hide();
	$("#li_" + element_id + " .mf_signature_type").hide();
	$("#li_" + element_id + " .mf_signature_switch a").removeClass('active');

	//show/hide the signature content pad
	if (signature_type == 'draw') {
		$("#li_" + element_id + " .mf_signature_draw").show();
		//when switching to signature pad draw, reset the previously entered signature
		var signature_canvas = document.getElementById('mf_canvas_signature_pad_' + element_id);
		var signature_pad = new SignaturePad(signature_canvas);

		refresh_signature(signature_pad, signature_canvas);
		$("#element_" + element_id).val('');
		$("#li_" + element_id + " .mf_signature_switch a.sig_switch_draw").addClass('active');
	} else {
		$("#li_" + element_id + " .mf_signature_type").show();
		$("#li_" + element_id + " .mf_signature_switch a.sig_switch_type").addClass('active');
		$("#element_" + element_id).val($("#element_" + element_id + "_text_signature").val());
	}
}
//Check if HTML5 uploader is supported by the browser
function is_support_html5_uploader() {
	if (window.File && window.FileList && window.Blob && (window.FileReader || window.FormData)) {
		return true;
	} else {
		return false;
	}
}