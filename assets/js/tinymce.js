$(function () {
	"use strict";

	//Tinymce editor
	if ($("#tinymceExample").length) {
		tinymce.init({
			selector: "#tinymceExample",
			height: 400,
			default_text_color: "red",
			plugins: [
				"advlist",
				"lists",
				"charmap",
				"preview",
				"searchreplace",
				"visualblocks",
				"fullscreen",
				"insertdatetime",
				"table",
				"help",
				"wordcount",
			],
			toolbar1:
				"undo redo paste | styleselect | bold italic | fontfamily fontsize  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat ",
			image_advtab: true,
			content_css: [],
		});
	}
});
