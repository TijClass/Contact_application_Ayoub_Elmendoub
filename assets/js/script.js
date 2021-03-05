function load_data() {
	let html = '';
	$.post("fetch.php",
		{action: "fetchAllPerson"},
		function (data) {

		for (let i = 0; i < data.length; i++) {
			const row = data[i];
			html += '<tr>';
			html += '<td width="10%">'+row.id+'</td>';
			html += '<td width="10%">'+row.fname+'</td>';
			html += '<td width="10%">'+row.lname+'</td>';
			html += '<td width="20%">'+row.email+'</td>';
			html += '<td width="10%">'+row.address+'</td>';
			html += '<td width="10%">'+row.phone+'</td>';
			html += '<td align="center" width="10%">'+row.group+'</td>';
			html += '<td align="center" width="20%"><button type="button" name="edit" class="btn btn-success btn-xs edit"  id="'+row.id+'">Edit</button> <button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'+row.id+' class="ml-4" href="#">Delete</button></td>';
			
		}
		$('#contact-data').html(html);
	},"json");

}

$(document).ready(function () {

	load_data();

	$("#user_dialog").dialog({
		autoOpen: false,
		width: 460
	});

	$('#add').click(function () {
		$("#user_form :input").not(":radio").val('');
		$("#user_form :input").prop('checked', false);
		$('#user_dialog').attr('title', 'Add Person');
		$('#action').val('insert');
		$("#user_dialog").dialog('open');
	});

	$('#user_form').on('submit', function (event) {
		event.preventDefault();
		var form_data = $(this).serialize();
		console.log(form_data);
		$.post("fetch.php",form_data,function (data) {
			$('#user_dialog').dialog('close');
			$('#action_alert').html(data);
			$('#action_alert').dialog('open');
			load_data();
		});

	});

	$('#action_alert').dialog({
		autoOpen: false
	});

	$(document).on('click', '.edit', function () {
		var id = $(this).attr('id');
		var action = 'fetchPerson';

		$.post("fetch.php", {
			id: id,
			action: action
		}, function (data) {

			$('#fname').val(data[0].fname);
			$('#lname').val(data[0].lname);
			$('#email').val(data[0].email);
			$('#address').val(data[0].address);
			$('#phone').val(data[0].phone);
			$('#' + data[0].group).attr("checked", "checked");

			$('#user_dialog').attr('title', 'Edit Person');
			$('#action').val('update');
			$('#hidden_id').val(id);
			$('#user_dialog').dialog('open');
		}, "json");

	});

	$('#delete_confirmation').dialog({
		autoOpen: false,
		modal: true,
		buttons: {
			Ok: function () {
				var id = $(this).data('id');
				var action = 'delete';
				$.post("fetch.php", {
					id: id,
					action: action
				}, function (data) {
					$('#delete_confirmation').dialog('close');
					$('#action_alert').html(data);
					$('#action_alert').dialog('open');
					load_data();
				});
			},
			Cancel: function () {
				$(this).dialog('close');
			}
		}
	});

	$(document).on('click', '.delete', function () {
		var id = $(this).attr("id");
		$('#delete_confirmation').data('id', id).dialog('open');
	});

	$(".ui-dialog-titlebar-close").html("<i class='fa fa-close' style='position:absolute;top:0;left:2px;color:red;'></i>");

});