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
	var canvas = document.getElementById('mf_canvas_signature_pad_14');
	var signature_pad = new SignaturePad(canvas);
	signature_pad.clear();
	$("#element_14").val('');
}
//show/hide the draw/type signature content
function switch_signature_type(element_id, signature_type) {
	$(".mf_signature_draw").hide();
	$(".mf_signature_type").hide();
	$(".mf_signature_switch a").removeClass('active');

	//show/hide the signature content pad
	if (signature_type == 'draw') {
		$(".mf_signature_draw").show();
		var signature_canvas = document.getElementById('mf_canvas_signature_pad_14');
		var signature_pad = new SignaturePad(signature_canvas);

		refresh_signature(signature_pad, signature_canvas);
		$("#element_14").val('');
		$(".sig_switch_draw").addClass('active');
	} else {
		$(".mf_signature_type").show();
		$(".sig_switch_type").addClass('active');
		$("#element_14").val($("#input_name").val());
	}
}


