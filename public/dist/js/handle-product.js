    $("#main-img").change(function(e) {
        var files = e.target.files;
        var file = files[0];
        var reader = new FileReader();
        var element = '';
        reader.onload = function() {
            var dataUrl = reader.result;
            var element ='<div class="box-main-img-preview"><img src="'+ dataUrl +'" class="main-img-preview-detail"><button id="del-main-image-pre"><i class="fas fa-trash-alt"></i></button><input type="hidden" name="main-image-base64" value="'+ dataUrl +'"></div>';
            $("#main-img-preview").html(element);
            $("#del-main-image-pre").click(function() {
                $(this).parent(".box-main-img-preview").remove();
                $("#main-img").val('');
            });
        };
        reader.readAsDataURL(file);
    });

    $("#multi-img").change(function(e) {
        var files = e.target.files;
        $.each(files, function(index, files) {
            var reader = new FileReader();
            reader.readAsDataURL(files);
            reader.onload = function(e) {
                var elements = '<div class="box-main-img-preview">';
                    elements += '<img class="main-img-preview-detail" src="' + e.target.result + '">';
                    elements += '<input name="other-image[]" type="hidden" value="' + e.target.result + '">';
                    elements += '<button type="button" class="del-other-image-pre"><i class="fas fa-trash-alt"></i></button>';
                    elements += '</div>';
                $("#multi-img-preview").append(elements);
                $(".del-other-image-pre").click(function() {
                    $(this).parent(".box-main-img-preview").remove();
                    $("#multi-img").val('');
                });                
            }
        });

    });

    // $('#products-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: '{!! route('product.getData') !!}',
    //     columns: [
    //         { data: 'name', name: 'name' },
    //         { data: 'desc', name: 'desc' },
    //         { data: 'price', name: 'price' },
    //         { data: 'created_at', name: 'created_at' },
    //     ]
    // });
// $(document).ready(function() {
    
//     if($('#radio1').is(":checked")) {
//         $("#type1").show();
//     };

//     if($('#radio2').is(":checked")) {
//         $("#type2").show();
//     };

//     $('#radio1').change(function(){
//          if ($(this).is(":checked")) {
//                 $("#type1").show();
//                 $("#type2").hide();
//                 $("#type2").val(null);
//             }
//     });  

//     $('#radio2').change(function(){
//          if ($(this).is(":checked")) {
//                 $("#type1").hide();
//                 $("#type2").show();
//                 $("#type1").val(null);
                
//             }
//     });  
// })
// 
// 
// if($('#option1').is(":selected")) {
//     $("#type1").show();
// };
// if($('#option2').is(":selected")) {
//     $("#type2").show();
// };

// $('#type-select').change(function() {
//     var value = $(this).val();
//     if(value == 1) {
//         $("#type1").show();
//         $("#type2").hide();
//         $("#type2").val(null);
//     } else if(value == 2) {
//         $("#type2").show();
//         $("#type1").hide();
//         $("#type1").val(null);
//     } else {
//         $("#type2").hide();
//         $("#type1").hide();
//         $("#type1").val(null);   
//         $("#type2").val(null);        
//     }

// });

$("#type-select option").each(function() {
    if($(this).is(':selected')) {
        alert($(this).attr("value"));
    }
})

// $('#type-select option').each(function() {
//     var value = $(this).val();
//     if ($(this).is(':selected')) {
//         $('#value'+ value +'').show();
//     }
// })