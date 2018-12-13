
$(document).ready(function() {

	var token = $("meta[name=csrf-token]").attr('content');
	var home = "/admin";
	var base_url = $("meta[name=base-url]").attr('content');
	var loc = $(location).attr('href');
	
	$(".app-menu li a").removeClass('active');
	$(".app-menu__item[href='"+loc+"']").addClass('active');
	
	// parsley
	$("#new_notice").parsley();
	$("#librarian_form").parsley();
	$("#return_form").parsley();
	$("#return_form").parsley();
	$("#registerUser").parsley();

	// end parsley

	// FAQS
	var faqs_tables = $("#faq_table").DataTable({
		"order": [[ 4, "desc" ]],
		'processing' : true,
		'serverSide' : true,
		searchDelay: 1000,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + 'faqs/data',
			'data' : {
				'_token' : token
			}

		}, 
		'columns' : [

		{'name' : 'name', width : '15%'},
		{'name' : 'question', width : '30%'},
		{'name' : 'details', width : '35%'},
		{"name" : 'status', width : '10%'},
		{'name' : 'id' ,orderable:false, width : '10%'}
		],

	});
	
	$("#answer").on("hidden.bs.modal", function () {
		$(".modal-content").hide();
		$("#answer #alert").hide();
	});

	$("#faq_table").on('click','.answer',function(){
		$("#answer_form")[0].reset();
		var id = $(this).data('id');

		$.ajax({
			type : 'POST',
			url : base_url + 'faqs/find',
			data : {
				_token : token,
				id : id
			},
			success: function (data) {
				var data = JSON.parse(data);
				$("#modal-title").text(data.question);
				$(".modal-body #answer").text(data.answer);
				$("#faq-id").val(data.id);
				$(".modal-content").show();
			}
		});

		$("#answer_form").submit(function(e) {
			e.preventDefault();
			var btn = $("#answer_form button[type='submit'] .text");
			$("#answer_form button[type='submit']").prop('disabled',true);
			$.ajax({
				type : 'PATCH',
				url : base_url + 'faqs/answer',
				data : {
					_token : token,
					_method : 'PATCH',
					answer : $("textarea[name='answer']").val(),
					id : $("#faq-id").val()
				},
				beforeSend:function() {
					btn.text('');
					$(".m-loader").show();
				},
				success: function (data) {
					$(".m-loader").hide();
					btn.text('Save');
					$("#answer_form button[type='submit']").prop('disabled',false);
					$("#answer #alert").fadeIn();
				}
			});
		})

	})

	$("#faq_table").on('click','.delete',function() {
		var id = $(this).data('id');
		var row = $(this).parents('tr');
		$.confirm({
			title: 'Delete Question?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'delete Question',
					action: function () {
						$.ajax({
							method : 'DELETE',
							url : base_url + 'faqs/destroy',
							data : {
								_token : token,
								_method : 'DELETE',
								id : id
							},
							success : function() {
								$.alert('Deleted the user!');
								row.remove();
							}
						})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
	})

	$("#faq_table").on('click','.approve',function() {
		var id = $(this).data('id');
		var row = $(this).parents('tr');
		var elem = $(this);
		$.confirm({
			title: 'Approve Question? This will show in faqs',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-success',
					text: 'Approve',
					action: function () {
						$.ajax({
							method : 'PATCH',
							url : base_url + 'faqs/approve',
							data : {
								_token : token,
								_method : 'PATCH',
								id : id
							},
							success : function() {
								$.alert('Faq approveed!');
								row.find('td').eq(3).text('Approved');
								elem.removeClass('approve');
								elem.addClass('disapprove');
								elem.text('Disapprove')						
							}
						})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
	})

	$("#faq_table").on('click','.disapprove',function() {
		var id = $(this).data('id');
		var row = $(this).parents('tr');
		var elem = $(this);
		$.confirm({
			title: 'Disapprove Question? This won\'t show faqs',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-warning',
					text: 'Disapprove',
					action: function () {
						$.ajax({
							method : 'PATCH',
							url : base_url + 'faqs/approve',
							data : {
								_token : token,
								_method : 'PATCH',
								id : id
							},
							success : function() {
								$.alert('Faq Disapproved!');
								row.find('td').eq(3).text('Pending');
								elem.removeClass('disapprove');
								elem.addClass('approve');
								elem.text('Approve')						
							}
						})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
	})

	// End FAQS


	// Books

	$(".cancel").click(function(){
		window.location.href = home;
	})
	var books_table = $("#books_table").DataTable({
		responsive : true,
		"order": [[ 6, "desc" ]],
		'pageLength' : 25,
		'processing' : true,
		'serverSide' : true,

		language: {
			searchPlaceholder: "Search books"
		},
		searchDelay: 1000,
		"bSort": true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + '/admin/books/data',
			'data' : {
				'_token' : token
			}

		},
		'columns' : [
		{'name' : 'location_symbol', width : '5%'},
		{'name' : 'degree_program', width : '20%' },
		{'name' : 'title', width : '25%'},
		{"name" : 'author1', width : '20%'},
		{"name" : 'subjectCode_description', width : '5%'},
		{"name" : 'status', width : '10%'},
		{"name" : 'id', orderable : false, width : '10%'} 
		],
		initComplete : function() {
			$("#books_table_length").append('&nbsp;&nbsp;&nbsp;<select id="filter" style="width:180px;" class="form-control form-control-sm"><option value="">Filter</option><option value="BSC">BSC</option><option value="General Education">General Education</option><option value="BSBA">BSBA</option><option value="BEED">BEED</option><option value="BSED">BSED</option><option value="BSIT">BSIT</option><option value="BSCS">BSCS</option><option value="General Collection" >General Collection</option><option value="SHS">SHS</option><option value="JSH">JHS</option><option value="GS">GS</option><option value="BEEd/BSed">BEEd/BSEd</option><option value="General Education - BSIT">General Education - BSIT</option><option value="General Education - BSC">General Education - BSC</option><option value="IT/CS">IT/CS</option><option value="General Education - BEEd">General Education - BEEd</option><option value="General Education - BSBA">General Education - BSBA</option></select>')
			$("#filter").change(function() {

				books_table.column(1).search( this.value ).draw();
				books_table.search('');
			})
		}
	});


	$("#books_table").on('click','.delete', function() {
		var id = $(this).data('id');
		var row = $(this).parents('tr');
		$.confirm({
			title: 'Are you sure you want to permanently delete that book?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Delete',
					action: function () {
						$.ajax({
							method : 'DELETE',
							url : base_url + '/admin/books/delete',
							data : {
								_token : token,
								_method : 'DELETE',
								id : id
							},
							success : function() {
								$.alert('Book deleted');
								row.remove();			
							}
						})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
	})

	$("#books_table").on('click','.edit',function() {
		$(this).find('form').submit();
	})
	// End Books


	// transactions
	var timeoutID;
	$("#member_id").keyup(function() { 
		var id = $(this).val();
		var elem = $(this);
		clearTimeout(timeoutID);

		timeoutID  = setTimeout(function() {
			
		     memberFind(id,elem);

		},300);
		 
	 
	})

	function memberFind(id,elem) {
		var ajax = $.ajax({
			type : 'POST',
			url : base_url + '/admin/member/find',
			data : {
				_token : token,
				id : id
			}, 
			success:function(data) { 
			 	 if (data.length) {
			 	 	var data = JSON.parse(data);
			 	 	var type = data.type.type;
			 	 	elem.blur();
					$.alert(type + ' Found!'); 	
						if (type == 'student') { 
							$("#faculty").hide();
							$("#student").show();

							$("#s_name").val(data.data.name);
							$("#student input[value='"+data.data.gender+"']").prop('checked',true);
							$("#student select[name='course']").val(data.data.course);
			 
							$("#student select[name='year']").val(data.data.year);
							$("#student input[name='address']").val(data.data.address);
							$("#student input[name='contact']").val(data.data.contact);

							$("#m_id").val(data.data.id);
							$("#membership_type").val('student');
						}else if (type === 'faculty'){
							console.log(data.data);
							$("#faculty input[name='f_name']").val(data.data.name);
							$("#faculty input[value='"+data.data.gender+"']").prop('checked',true);
							$("#faculty select[name='f_course']").val(data.data.course);
			 				$("#faculty input[name='f_position']").val(data.data.position); 
							$("#faculty input[name='f_address']").val(data.data.address);
							$("#faculty input[name='f_contact']").val(data.data.contact);
							$("#m_id").val(data.data.id);
							$("#membership_type").val('faculty');
							$("#student").hide();
							$("#faculty").show();
							
						}
						 
			 	 }
 
			}

		});
	}
	$("#membership_type").change(function() {
		var val = this.value;
		if (val === 'student') {
			$("#faculty").hide();
			$("#student").fadeIn();
			return false;
		}
		$("#student").hide();
		return $("#faculty").fadeIn();
	});

	$("#barrow").change(function() {
		var val = this.value;
		if (val === 'book') {
			$("#barrow_media").hide();
			$("#barrow_book").fadeIn();
			return false;
		}
		$("#barrow_book").hide();
		return $("#barrow_media").fadeIn();
	});

	var init = false;
	
	$("#select_book").click(function() {
		
		$("#select-book-modal").modal('toggle');

		if (!init) {
			var select_books_table = $("#select_books_table").DataTable({
				responsive : true,
				"order": [[ 1, "desc" ]],
				'processing' : true,
				'pageLength' : 5,
				"lengthMenu": [5, 10, 25, 50, 75, 100 ],
				'processing' : true,
				'serverSide' : true,
				searchDelay: 1000,
				language: {
					searchPlaceholder: "Search books"
				},
				"bSort": true,
				'ajax' : {
					'type' : 'POST',
					'url' : base_url + '/books/selectData',
					'data' : {
						'_token' : token
					}
				},
				'columns' : [
				{'name' : 'id', width : '10%'},
				{'name' : 'degree_program', orderable:false, width : '20%'},
				{'name' : 'title', width : '25%'},
				{"name" : 'author1', width : '25%'},
				{"name" : 'status', width : '10%'},
				{"name" : 'loaning_period', width : '10%'} 
				],
				initComplete : function() {
					$("#select-book-modal").on('click','table tr',function() {
						var id = $(this).find('td').eq(0).text();
						var title = $(this).find('td').eq(2).text();
						$("#select-book-modal").modal('toggle');
						$("#book_id").val(id);
						$("#select_book").val(title);
					})
				}

			});

			init = true;
		}
	})

	function format ( d ) {
		console.log(d);
    // `d` is the original data object for the row
	    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
	        '<tr>'+
	            '<td>Returned Date:</td>'+
	            '<td>'+d[9]+'</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>Loaning Period:</td>'+
	            '<td>'+d[10]+'</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>Barrow Time:</td>'+
	            '<td>'+d[11]+'</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>Due Date:</td>'+
	            '<td>'+d[12]+'</td>'+
	        '</tr>'+
	        '<tr>'+
	            '<td>Penalty</td>'+
	            '<td>'+d[13]+' </td>'+
	        '</tr>'+
	    '</table>';
	}

	var transactions_table = $("#transactions_table").DataTable({
		"order": [[ 1, "desc" ]],
		'processing' : true,
		fixedColumn : true,
		'serverSide' : true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + '/admin/transactions/data',
			'data' : {
				'_token' : token
			}

		},
		searchDelay: 1000,
		'columns' : [
			{
	           "className":      'details-control',
	           "orderable":      false,
	           "data":           null,
	           "defaultContent": '',
	           width : '5%'
	       },
		{'name' : 'transaction_id'},
		{'name' : 'created_at', width : '15%'},
		{'name' : 'member_id', width : '15%'},
		{'name' : 'type', width : '10%'},
		{ 'name' : 'type',orderable :false},
		{'name' :'status', orderable : false, width : '20%'},
		{"name" : 'status'},
		{orderable : false}
	 
		],
		initComplete : function() {
			$("#transactions_table_length").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="transaction_status" style="width:100px;" class="form-control form-control-sm"><option value="">Status</option><option value="pending">Pending</option><option value="completed">Completed</option><option value="lost">Lost</option></select>')

			$("#transaction_status").change(function() {
			 
				transactions_table.column(6).search( this.value ).draw();
				 
			});

			$("#transactions_table_filter input[type='search']").keyup(function() {
				$("#transaction_status").val('');
				transactions_table.column(6).search( '').draw();
			});
		}

	});


	$('#transactions_table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = transactions_table.row( tr );
 		console.log(row);
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

	$("#transactions_table").on('click','.return',function() {
		 id = $(this).data('id');
		 var row = $(this).parents('tr');

		 $.confirm({
			title: 'Complete Transaction?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-success',
					text: 'Yes',
					action: function () {
						$.ajax({
							method : 'POST',
							url : base_url + '/admin/return/update',
							data : {
								_token : token, 
								_method : 'POST',								
								transaction_id : id
							},
							success : function() {
								$.alert('Transactions completed');
								row.find('td').eq(7).text('Completed');	
							}
						})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
	})

	$("#transactions_table").on('click','.lost',function() {
		 id = $(this).data('id');
		 var row = $(this).parents('tr');

		 $.confirm({
			title: 'Lost Resource?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Yes',
					action: function () {
						$.ajax({
							method : 'POST',
							url : base_url + '/admin/lost/update',
							data : {
								_token : token, 
								_method : 'POST',								
								transaction_id : id
							},
							success : function() {
								$.alert('Lost resource recorded successfully');
								row.find('td').eq(7).text('Lost');	
							}
						})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
	})
	// End Transactions

	// Media
	var media_tables = $("#media_table").DataTable({
		"order": [[ 7, "desc" ]],
		'processing' : true,
		'serverSide' : true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + '/admin/media/adminData',
			'data' : {
				'_token' : token
			}
		},
		searchDelay: 1000,
		'columns' : [

			{'name' : 'accession_number', width : '10%'},
			{'name' : 'title', width : '25%'},
			{'name' : 'author', width : '20%'},
			{"name" : 'type', width : '5%'},
			{"name" : 'source_fund', width : '10%'},
			{"name" : 'price', width : '10%'},
			{"name" : 'status', width : '5%'},
			{'name' : 'id' ,orderable:false, width : '5%'}
		],

	});
	var select_media_init = false;
	$("#select_media").click(function() {
		$("#select-media-modal").modal('toggle');
		if (select_media_init === false) {
			$("#select_media_table").DataTable({
				"order": [[ 0, "desc" ]],
				'processing' : true,
				'serverSide' : true,
				'ajax' : {
					'type' : 'POST',
					'url' : base_url + '/admin/media/selectData',
					'data' : {
						'_token' : token
					}
				},
				searchDelay: 1000,
				'columns' : [

					{'name' : 'id', width : '10%'},
					{'name' : 'title', width : '30%'},
					{'name' : 'author', width : '25%'},
					{"name" : 'type', width : '10%'},
			 
					{'name' : 'id' ,orderable:false, width : '10%'}
				],
			});

			select_media_init = true;
		}
		
	})

	//Select Row Get ID and TITLTE OF MEDIA
	selectRow($("#select_media_table"), $('table tr'));

	$("#media_table").on('click','.edit',function() {
		$(this).find('form').submit();
	});

	$("#media_table").on('click','.delete', function() {
		var id = $(this).data('id');
		var row = $(this).parents('tr');
		$.confirm({
			title: 'Are you sure you want to permanently delete that media?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Delete',
					action: function () {
						$.ajax({
							method : 'DELETE',
							url : base_url + '/admin/media/delete',
							data : {
								_token : token,
								_method : 'DELETE',
								id : id
							},
							success : function() {
								$.alert('Media deleted');
								row.remove();			
							}
						})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
	})
	// end media

	// students

	var student_row;

	$("#students_table").DataTable({
		"order": [[ 0, "desc" ]],
		'processing' : true,
		'serverSide' : true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + '/admin/students/data',
			'data' : {
				'_token' : token
			}
		},
		searchDelay: 1000,
		rowID : 'member_id',
		'columns' : [
			{'name' : 'member_id'},
			{'name' : 'name'},
			{'name' : 'gender'},
	 		{"name" : 'course'},
	 		{"name" : 'year'},
	 		{"name" : 'address'},
	 		{"name" : 'contact'},
			{'name' : 'id' ,orderable:false}
		],
	});
 	
 	$("#students_table").on('click','.edit',function() {
 		student_row = $(this).parents('tr');
 
 		var id = $(this).data('id');
 		$.ajax({
 			type : 'post',
 			url : base_url + '/admin/students/find',
 			data : {
 				_token : token,
 				id : id
 			},
 			success : function(data) {
 				var s = JSON.parse(data);
 				$("#name").val(s.name);
 				$("#course").val(s.course);
 				$("#contact").val(s.contact);
 				$("#year").val(s.year);
 				$("#address").val(s.address);
 				$("#s_id").val(s.id);
 				$("input[value='"+ s.gender +"']").prop('checked',true);
 				$("#students-modal").modal('toggle');
 			}
 		})
 		
 	})

 	$("#students_table").on('click','.delete',function() {
 		student_row = $(this).parents('tr');
 		var id = $(this).data('id');
 		$.confirm({
			title: 'Are you sure you want to permanently delete that student?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Delete',
					action: function () {
						$.ajax({
				 			type : 'DELETE',
				 			url : base_url + '/admin/students/destroy',
				 			data : {
				 				_token : token,
				 				_method : 'DELETE',
				 				id : id
				 			},
				 			success : function(data) {
				 				 $.notify({
				 					icon : 'fa fa-trash',
									message: ' Student deleted successfully' 
								},{
									// settings
									type: 'danger',
									z_index : 2000,
								});

				 				 student_row.remove();
				 			}
				 		})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});
 		
 		
 	})

 	$("#student-update").submit(function(e) {
 		  	
 		 e.preventDefault();
 		 $.ajax({
 		 	type : 'PATCH',
 		 	url : base_url + '/admin/students/update',
 		 	data : {
 		 		_token : token,
 		 		_method : 'PATCH',
 		 		name : $("#name").val(),
				course : $("#course").val(),
				contact : $("#contact").val(),
				year : $("#year").val(),
				address : $("#address").val(),
				gender : $("input[name='gender']:checked").val(),
				id : $("#s_id").val()
 		 	},
 		 	beforeSend : function() {
 		 		$('.loader').show();
 		 		$("button[type='submit'] .text").text('');
 		 	},
 		 	success: function() {
 		 		student_row.find('td').eq(1).text($("#name").val())
				student_row.find('td').eq(2).text($("input[name='gender']:checked").val())
				student_row.find('td').eq(3).text($("#course").val())
				student_row.find('td').eq(4).text($("#year").val())
				student_row.find('td').eq(5).text($("#address").val())
				student_row.find('td').eq(6).text($("#contact").val())
 		 		 $.notify({
 					icon : 'fa fa-check',
					message: 'Student information updated successfully!' 
				},{
					// settings
					type: 'success',
					z_index : 2000,
				});

 		 		$('.loader').hide();
	 			$("button[type='submit'] .text").text('Save Changes');
	 			$("#students-modal").modal('toggle');
 		 	}
 		 });
 	})
	// end students

	// Start faculties

	var faculties_row;
	$("#faculties_table").DataTable({
		"order": [[ 0, "desc" ]],
		'processing' : true,
		'serverSide' : true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + '/admin/faculties/data',
			'data' : {
				'_token' : token
			}
		}, 
		searchDelay: 1000,
		'columns' : [
			{'name' : 'member_id'},
			{'name' : 'name'},
			{'name' : 'gender'},
	 		{"name" : 'position'}, 
	 		{"name" : 'address'},
	 		{"name" : 'contact'},
			{'name' : 'id' ,orderable:false}
		],
	});

	$("#faculties_table").on('click','.edit',function() {
 		faculties_row = $(this).parents('tr');
 
 		var id = $(this).data('id');
 		$.ajax({
 			type : 'post',
 			url : base_url + '/admin/faculties/find',
 			data : {
 				_token : token,
 				id : id
 			},
 			success : function(data) {
 				var s = JSON.parse(data);
 				$("#name").val(s.name);
 				$("#position").val(s.position);
 				$("#contact").val(s.contact); 
 				$("#address").val(s.address);
 				$("#s_id").val(s.id);
 				$("input[value='"+ s.gender +"']").prop('checked',true);
 				$("#faculties-modal").modal('toggle');
 			}
 		})
 		
 	})

 	$("#faculties_table").on('click','.delete',function() {
 		faculties_row = $(this).parents('tr');
 		var id = $(this).data('id');
 		$.confirm({
			title: 'Are you sure you want to permanently delete that faculty?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Delete',
					action: function () {
						$.ajax({
				 			type : 'DELETE',
				 			url : base_url + '/admin/faculties/destroy',
				 			data : {
				 				_token : token,
				 				_method : 'DELETE',
				 				id : id
				 			},
				 			success : function(data) {
				 				 $.notify({
				 					icon : 'fa fa-trash',
									message: ' Faculty deleted successfully' 
								},{
									// settings
									type: 'danger',
									z_index : 2000,
								});

				 				 faculties_row.remove();
				 			}
				 		})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});

 	})

 	$("#faculty-update").submit(function(e) {
 		  	
 		 e.preventDefault();
 		 $.ajax({
 		 	type : 'PATCH',
 		 	url : base_url + '/admin/faculties/update',
 		 	data : {
 		 		_token : token,
 		 		_method : 'PATCH',
 		 		name : $("#name").val(),
				position : $("#position").val(),
				contact : $("#contact").val(), 
				address : $("#address").val(),
				gender : $("input[name='gender']:checked").val(),
				id : $("#s_id").val()
 		 	},
 		 	beforeSend : function() {
 		 		$('.loader').show();
 		 		$("button[type='submit'] .text").text('');
 		 	},
 		 	success: function() {
 		 		faculties_row.find('td').eq(1).text($("#name").val())
				faculties_row.find('td').eq(2).text($("input[name='gender']:checked").val())
				faculties_row.find('td').eq(3).text($("#position").val()) 
				faculties_row.find('td').eq(4).text($("#address").val())
				faculties_row.find('td').eq(5).text($("#contact").val())
 		 		 $.notify({
 					icon : 'fa fa-check',
					message: 'Faculty information updated successfully!' 
				},{
					// settings
					type: 'success',
					z_index : 2000,
				});

 		 		$('.loader').hide();
	 			$("button[type='submit'] .text").text('Save Changes');
	 			$("#faculties-modal").modal('toggle');
 		 	}
 		 });
 	})
	// End Faculties
	
	// settings
		var edit = false;
		$("#settings .edit").click(function(e) {
			e.preventDefault();
			$("#tag-line").prop('disabled',false).focus();
			$("#content").prop('disabled',false);
			$("#settings button[type='submit']").prop('disabled',false);
			edit = true;
		})
	// end settings

	// Notices
	var notices_row;
	var notice_table = $("#notices_table").DataTable({
		"order": [[ 0, "desc" ]], 
		'processing' : true,
		'serverSide' : true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + '/admin/notices/data',
			'data' : {
				'_token' : token
			}
		}, 
		searchDelay: 1000,
		'columns' : [ 
			{'name' : 'title',width:'13%'}, 
			{'name' : 'created_at',width:'20%'},
			{'name' : 'content',width:'60%'},
			{orderable:false}
		],
 
	});

	

	$("#notices_table").on('click','.edit',function() {
 		notices_row = $(this).parents('tr');
 
 		var id = $(this).data('id');
 		$.ajax({
 			type : 'post',
 			url : base_url + '/admin/notices/find',
 			data : {
 				_token : token,
 				id : id
 			},
 			success : function(data) {
 				var s = JSON.parse(data);
 				$("#title").val(s.title);
 				$("#content").val(s.content);
 				$("#s_id").val(s.id);
 				$("#notices-modal").modal('toggle');
 			}
 		})
 		
 	})

 	$("#notice-update").submit(function(e) {
 		  	
 		 e.preventDefault();
 		 $.ajax({
 		 	type : 'PATCH',
 		 	url : base_url + '/admin/notices/update',
 		 	data : {
 		 		_token : token,
 		 		_method : 'PATCH',
 		 		title : $("#title").val(),
				content : $("#content").val(), 
				id : $("#s_id").val()
 		 	},
 		 	beforeSend : function() {
 		 		$('.loader').show();
 		 		$("button[type='submit'] .text").text('');
 		 	},
 		 	success: function() {
 		 		notices_row.find('td').eq(1).text($("#title").val()) 
 		 		 $.notify({
 					icon : 'fa fa-check',
					message: 'Faculty information updated successfully!' 
				},{
					// settings
					type: 'success',
					z_index : 2000,
				});

 		 		$('.loader').hide();
	 			$("button[type='submit'] .text").text('Save Changes');
	 			$("#notices-modal").modal('toggle');
 		 	}
 		 });
 	})

 	$("#notices_table").on('click','.delete',function() {
 		notices_row = $(this).parents('tr');
 		var id = $(this).data('id');
 		$.confirm({
			title: 'Are you sure you want to permanently delete that notice?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Delete',
					action: function () {
						$.ajax({
				 			type : 'DELETE',
				 			url : base_url + '/admin/notices/destroy',
				 			data : {
				 				_token : token,
				 				_method : 'DELETE',
				 				id : id
				 			},
				 			success : function(data) {
				 				 $.notify({
				 					icon : 'fa fa-trash',
									message: ' Notice deleted successfully' 
								},{
									// settings
									type: 'danger',
									z_index : 2000,
								});

				 				 notices_row.remove();
				 			}
				 		})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});

 	})

 	$("#avatar_upload").change(function() {
 		 readImage(this);
 	});

 	function readURL(input) {

	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $('#preview').attr('src', e.target.result);
	      $("#preview").fadeIn();
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}
 	
 	$("#librarians_table").DataTable({ 
		'serverSide' : true,
		'processing' : true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + 'librarians/data',
			'data' : {
				'_token' : token
			}
		},
		searchDelay: 1000,
		'columns' : [
		{'name' : 'id',orderable:false, width : '10%'},
		{'name' : 'name', width : '35%'},
		{'name' : 'position', width : '20%'}, 
		{'name' : 'id' ,orderable:false, width : '5%'}
		],

	});

 	var librarian_row;
	$("#librarians_table").on('click','.delete',function() {
 		librarian_row = $(this).parents('tr');
 		var id = $(this).data('id');
 		$.confirm({
			title: 'Are you sure you want to permanently delete that librarian?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Delete',
					action: function () {
						$.ajax({
				 			type : 'DELETE',
				 			url : base_url + '/admin/librarians/destroy',
				 			data : {
				 				_token : token,
				 				_method : 'DELETE',
				 				id : id
				 			},
				 			success : function(data) {
				 				 $.notify({
				 					icon : 'fa fa-trash',
									message: ' Notice deleted successfully' 
								},{
									// settings
									type: 'danger',
									z_index : 2000,
								});

				 				 librarian_row.remove();
				 			}
				 		})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});

 	})

 	$("#librarians_table").on('click','.edit',function() {
 		librarian_row = $(this).parents('tr');
 
 		var id = $(this).data('id');
 		$.ajax({
 			type : 'post',
 			url : base_url + '/admin/librarians/find',
 			data : {
 				_token : token,
 				id : id
 			},
 			success : function(data) {
 				var s = JSON.parse(data);
 				var image = base_url +'/storage/avatar/' + s.image;
 				$("#old_image").val(s.image);
 				 $("#s_id").val(s.id);
 				$("#name").val(s.name);
 				$("#position").val(s.position);
 				$("#description").val(s.description);
 				 $("#preview").attr('src', image);
 				 $("#preview").show();
 				$("#librarians-modal").modal('toggle');
 			}
 		})
 	})

 	$("#librarian-update").submit(function(e) {
 		e.preventDefault();
 		var formData = new FormData($(this)[0]);
 	  
 		$.ajax({
 			method : 'POST',
 			url : base_url + '/admin/librarians/update', 
 			type: 'POST',
 			headers : {
 				'X-CSRF-TOKEN' : token
 			},
            	data : formData,
            	dataType:'json', 
		      processData: false,
		      contentType: false,
		      beforeSend : function() {
		      	$("button[type='submit'] .text").text('');
		      	$(".loader").show();
		      },
		     delay : 5000,
		     beforeSend : function() {
		     	$("#librarian-update").loading({
                    circles : 1,
                    overlay : true,
                    base : 0.1,  
                });
		     },
 			success : function(data) {
 				$("#librarian-update").loading({
                    destroy : true
                	});
 				if (data) {
 					librarian_row.find('td').eq(1).text($("#name").val());
 					librarian_row.find('td').eq(2).text($("#position").val());
 					librarian_row.find('td').eq(0).find('img').attr('src', avatar);
 					$("button[type='submit'] .text").text('Save Changes');
		      		$(".loader").hide();
 					$("#librarians-modal").modal('toggle');
 					$.notify({
	 					icon : 'fa fa-info',
						message: ' Changes Saved!' 
					},{
						// settings
						type: 'success',
						z_index : 2000,
					});

					 
 				}
 				
 				$("#librarian-update")[0].reset();
 			},

 		})
 	})

 	$("#avatar_upload").change(function() {
 		readURL(this);
 	})

 	$("#users_table").DataTable({ 
		'serverSide' : true,
		'processing' : true,
		'ajax' : {
			'type' : 'POST',
			'url' : base_url + 'users/data',
			'data' : {
				'_token' : token
			}
		},
		searchDelay: 1000,
		'columns' : [
			{'name' : 'name'},
			{'name' : 'position'}, 
			{'name' : 'role'},
			{orderable : false}
		],
		initComplete : function() {
			$("#users_table_length").append('&nbsp;&nbsp;&nbsp;&nbsp;<button id="add-user-btn" class="btn &nbsp;&nbsp;btn-default btn-sm" style="color:#495057;background-color:#fff;border:solid 2px #ced4da">Add User</button>')
			$("#add-user-btn").click(function() {
				$("#user-register").modal('toggle');
			})
		}
	});

	$("#registerUser").submit(function(e) {
		e.preventDefault();
		var form = $(this)[0];
 		var formData = new FormData(form);
 		var name = $("#r_name").val();
 		var email = $("#r_email").val();
 		var role = $("#r_role").val();
 		$.ajax({
 			method : 'POST',
 			url : base_url + '/admin/users/store', 
 			type: 'POST',
 			headers : {
 				'X-CSRF-TOKEN' : token
 			},
            	data : formData,
            	dataType:'json', 
		      processData: false,
		      contentType: false,
		      beforeSend : function() {
		      	$("button[type='submit'] .text").text('');
		      	$(".loader").show();
		      }, 
 			success : function(data) {
 				$("#users_table tbody").prepend('<tr><td>'+name+'</td><td>'+email+'</td><td>'+role+'</td><td>'+
 					'<div class="btn-group"> ' +
	                      '<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>'+
	                      '<div class="dropdown-menu">'+
	                        '<a class="dropdown-item edit" data-id="'+data +'" data-toggle="modal" data-target="#answer" >Edit</a>'+
	                        '<a class="dropdown-item delete" data-id="'+data+'" href="#" >Delete</a>'+
	                      '</div>'+
	                    '</div> '

 					+'</td></tr>');
 				$("button[type='submit'] .text").text('Register');
		      	$(".loader").hide();
		      	$("#preview").removeAttr('src');
		      	form.reset();
		      	$.notify({
 					icon : 'fa fa-info',
					message: ' User registered successfully!' 
				},{
					// settings
					type: 'success',
					z_index : 2000,
				});

				$("#user-register").modal('toggle');
 			},

 		})
	})
 	var user_row;
 	$("#users_table").on('click','.edit',function() {
 		user_row = $(this).parents('tr');
 		
 		var id = $(this).data('id');
 		$.ajax({
 			type : 'post',
 			url : base_url + '/admin/users/find',
 			data : {
 				_token : token,
 				id : id
 			},
 			success : function(data) {
 				var s = JSON.parse(data); 
 				var image = base_url +'/storage/avatar/' + s.avatar;
 				$("#old_image").val(s.image);
 				 $("#u_id").val(s.id);
 				$("#update-user input[name='name']").val(s.name);
 				$("#update-user input[name='email']").val(s.email);
 				$("#update-user select[name='role']").val(s.role);
 				 $("#avatar").attr('src', image);
 				 $("#avatar").show();
 				$("#librarians-modal").modal('toggle');
 				$("#user-update").modal('toggle');
 			}
 		})
 	})

 	$("#update-user").submit(function(e) {

		e.preventDefault();
		var form = $(this)[0];
 		var formData = new FormData(form); 
 		$.ajax({ 
 			method : 'post',
 			url : base_url + '/admin/users/updateRole',          
 			headers : {
 				'X-CSRF-TOKEN' : token
 			},
            	data : formData,
		      processData: false,
		      contentType: false,
		      beforeSend : function() {
		      	$("button[type='submit'] .text").text('');
		      	$(".loader").show();
		      }, 
 				success : function(data) { 
 				if (data) { 
 					user_row.find('td').eq(2).text($("#update-user select[name='role']").val());
 					$("button[type='submit'] .text").text('Update');
			      	$(".loader").hide();
			      	$("#preview").removeAttr('src');
			      	$("#user-update").modal('toggle');
			      	form.reset();
			      	$.notify({
	 					icon : 'fa fa-info',
						message: ' User updated successfully!' 
					},{
						// settings
						type: 'success',
						z_index : 2000,
					});
 				}
 			},

 		})
	})

	$("#users_table").on('click','.delete',function() {
 		user_row = $(this).parents('tr');
 		var id = $(this).data('id');
 		$.confirm({
			title: 'Are you sure you want to permanently delete that user?',
			content: 'This dialog will automatically trigger \'cancel\' in 8 seconds if you don\'t respond.',
			autoClose: 'cancelAction|8000',
			buttons: {
				deleteUser: {
					btnClass: 'btn btn-danger',
					text: 'Delete',
					action: function () {
						$.ajax({
				 			type : 'DELETE',
				 			url : base_url + '/admin/users/destroy',
				 			data : {
				 				_token : token,
				 				_method : 'DELETE',
				 				id : id
				 			},
				 			success : function(data) {
				 				 $.notify({
				 					icon : 'fa fa-trash',
									message: ' User deleted successfully' 
								},{
									// settings
									type: 'danger',
									z_index : 2000,
								});
				 				 user_row.remove();
				 			}
				 		})
					}
				},
				cancelAction: function () {
					$.alert('action is canceled');
				}
			}
		});

 	})

 	$("#avatar_u").change(function() {
 		 read_url(this);
 	});

 	$("#user-edit").click(function() {
 		$("#profile input").prop('disabled', false);
 		$("#upload_label").text('Upload image');
 		$("#profile button[type='submit']").prop('disabled',false);
 		$("#avatar_upload").show();


 	})

 	$("#profile").submit(function(e) {
 		e.preventDefault();
		var form = $(this)[0];
 		var formData = new FormData(form); 
 		$.ajax({ 
 			method : 'post',
 			url : base_url + '/admin/users/update',          
 			headers : {
 				'X-CSRF-TOKEN' : token
 			},
            	data : formData,
		      processData: false,
		      contentType: false,
		      beforeSend : function() {
		      	$("button[type='submit'] .text").text('');
		      	$(".loader").show();
		      	$("#profile").loading({
	                    circles : 1,
	                    overlay : true,
	                    base : 0.1,  
	                });
		      }, 
			success : function(data) { 

				$("#profile").loading({
					destroy : true
				});

				if (data) { 
					$("#profile input").prop('disabled', true);
		 		$("#upload_label").text('Avatar');
		 		$("#profile button[type='submit']").prop('disabled',true);
		 		$("#avatar_upload").hide();
		 		$.notify({
						icon : 'fa fa-info',
					message: ' Profile updated successfully' 
				},{
					// settings
					type: 'success',
					z_index : 2000,
				});
			}
 			},

 		})
 	})

 	function read_url(input) {

	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $('#avatar').attr('src', e.target.result);
	      $("#avatar").fadeIn();
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	// parsley
	$("#register_book_form").parsley();
	$("#media_register_form").parsley();
})


function selectRow() {
	$("#select_media_table").on('click', 'tr',function() {
		var id = $(this).find('td').eq(0).text();
		var title = $(this).find('td').eq(1).text();
		$("#select-media-modal").modal('toggle');
		$("#select_media").val(title);
		$("#media_id").val(id);
	})
}
var avatar;
function readImage(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) { 
          avatar = e.target.result;
      };

      reader.readAsDataURL(input.files[0]);
  }
}