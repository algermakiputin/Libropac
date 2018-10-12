var token = $("meta[name=csrf-token]").attr('content');

$(document).ready(function(){
    $('.collapse').on('show.bs.collapse', function () {
       $("#accordion").find('.collapse.in').collapse('hide');
       $(this).siblings('.card-header').addClass('active');

    });

    $('.collapse').on('hide.bs.collapse', function () {
        $(this).siblings('.card-header').removeClass('active');
    });
    $("#askForm").parsley();
    
    $("#askForm").submit(function(e) {
        $("#askForm button").prop('disabled',true);

        e.preventDefault();
        var name = $("#name").val();
        var question = $("#question").val();
        var details = $("#comments").val();
        $.ajax({
            type : 'POST',
            url : '/ask/store',
            data : {
                _token : token,
                name : name,
                question : question,
                details : details
            },
            beforeSend: function() {
                $(".loader-submit").show();
                $("#askForm button .text").text('');

            },
            success : function(data) {
                if (data == 1) {
                    $("#success").fadeIn();
                    $("#askForm")[0].reset();
                } 
                $("#askForm button").prop('disabled',false);
                $(".loader-submit").hide();
                $("#askForm button .text").text('Submit');

            },
            onError: function() {
                $("#askForm button").prop('disabled',false);
                $(".loader-submit").hide();
                $("#askForm button .text").text('Submit');
            }

        })
    })
 

    $("#pagination").on('click','.page-item a.page-link', function(e) {
     
        e.preventDefault();
   
        var link = $(this).attr('href');
        var page = link[link.length - 1];
    
        $.ajax({
            type : 'get',
            url : '/faqs/paginate?page=' + page,
            data : {
                _token : token
            },
            beforeSend : function() {
                $("#accordion").loading({
                    circles : 1,
                    overlay : true,
                    base : 0.1, 
                    top : '20%'
                });
            },
            success : function(data) {
                $("#accordion").loading({
                    destroy : true
                });
                var data = JSON.parse(data);

                $(".pagination").replaceWith(decodeEntities(data.links));
                $('#accordion').empty();
                $.each(data.data,function(i, data) { 
                     $("#accordion").append('<div class="card"><div class="card-header" id="heading'+i+'"><h5 class="mb-0"><a class="btn btn-link" data-toggle="collapse" data-target="#faq'+ data.id+'" aria-expanded="true" aria-controls="collapseOne"<b>Q. '+ data.question +'</b></a></h5></div><div id="faq'+data.id+'" class="collapse " aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body"><span class="faq-header">Answered by: '+ data.u_name +', on '+ data.updated_at +'</span>'+ data.answer+'</div></div></div></div>')
                })
                $('.collapse').on('show.bs.collapse', function () {
                $("#accordion").find('.collapse.in').collapse('hide');
                   $(this).siblings('.card-header').addClass('active');

                });

                $('.collapse').on('hide.bs.collapse', function () {
                    $(this).siblings('.card-header').removeClass('active');
                });
            }
        }); 
    });
    
    var books_table = $("#books_table").DataTable({
        responsive : true,
        "order": [[ 1, "desc" ]],
        'pageLength' : 25,
        'processing' : true,
        'serverSide' : true,
      
        language: {
            searchPlaceholder: "Search books"
        },
        "bSort": true,
        'ajax' : {
            'type' : 'POST',
            'url' : '/books/data',
            'data' : {
                '_token' : token
            }

        },
        'columns' : [
        {'name' : 'location_symbol',width:'5%'},
        {'name' : 'degree_program', orderable:false,width:'10%'},
        {'name' : 'title',width:'30%'},
        {"name" : 'author1',width:'20%'},
        {"name" : 'subjectCode_description',width:'20%'},
        {"name" : 'status',width:'10%'},
        {"name" : 'loaning_period',width:'5%'} 
        ],
        initComplete : function() {
            $("#books_table_length").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="filter" style="width:180px;" class="form-control form-control-sm"><option value="">All</option><option value="BSC">BSC</option><option value="General Education">General Education</option><option value="BSBA">BSBA</option><option value="BEED">BEED</option><option value="BSED">BSED</option><option value="BSIT">BSIT</option><option value="BSCS">BSCS</option><option value="General Collection" >General Collection</option><option value="SHS">SHS</option><option value="JSH">JHS</option><option value="GS">GS</option><option value="BEEd/BSed">BEEd/BSEd</option><option value="General Education - BSIT">General Education - BSIT</option><option value="General Education - BSC">General Education - BSC</option><option value="IT/CS">IT/CS</option><option value="General Education - BEEd">General Education - BEEd</option><option value="General Education - BSBA">General Education - BSBA</option></select>')
            $("#filter").change(function() {
                books_table.search('');
                books_table.column(1).search( this.value ).draw();
            })

           
        }
    });
    
    var media_table = $("#media_table").DataTable({
        responsive : true,
        "order": [[ 4, "desc" ]],
        'pageLength' : 25,
        'processing' : true,
        'serverSide' : true,
      
        language: {
            searchPlaceholder: "Search books"
        },
        "bSort": true,
        'ajax' : {
            'type' : 'POST',
            'url' : '/media/opac',
            'data' : {
                '_token' : token
            }

        },
        'columns' : [
        {'name' : 'accession_number'},
        {'name' : 'title'},
        {'name' : 'Author'},
        {"name" : 'degree_program'},
        {"name" : "id", orderable :false}

        ],
         
        initComplete : function() {
            $("#media_table_length").append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select id="filter" style="width:180px;" class="form-control form-control-sm"><option value="">All</option><option value="BSC">BSC</option><option value="General Education">General Education</option><option value="BSBA">BSBA</option><option value="BEED">BEED</option><option value="BSED">BSED</option><option value="BSIT">BSIT</option><option value="BSCS">BSCS</option><option value="General Collection" >General Collection</option><option value="SHS">SHS</option><option value="JSH">JHS</option><option value="GS">GS</option><option value="BEEd/BSed">BEEd/BSEd</option><option value="General Education - BSIT">General Education - BSIT</option><option value="General Education - BSC">General Education - BSC</option><option value="IT/CS">IT/CS</option><option value="General Education - BEEd">General Education - BEEd</option><option value="General Education - BSBA">General Education - BSBA</option></select>')
            $("#filter").change(function() {
                media_table.search('');
                media_table.column(3).search( this.value ).draw();
            })


        }
    });
});



var decodeEntities = (function() {
  // this prevents any overhead from creating the object each time
  var element = document.createElement('div');

  function decodeHTMLEntities (str) {
    if(str && typeof str === 'string') {
      // strip script/html tags
      str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
      str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
      element.innerHTML = str;
      str = element.textContent;
      element.textContent = '';
    }

    return str;
  }

  return decodeHTMLEntities;
})();