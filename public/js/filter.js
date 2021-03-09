    $(document).ready(function(){
    $('select[name="country"]').on('change', function(){
         var country = $(this).val();

         if (country){
            $.ajax({
                url: '/admin/lga/fetchStates/'+country,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="state"]').empty();
                     $('select[name="state"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="state"]').append(
                            '<option value="'+key+'">'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="state"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="state"]').on('change', function(){
         var state = $(this).val();
         
         if (state){
            $.ajax({
                url: '/admin/lga/fetchLgas/'+state,
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="lga"]').empty();
                     $('select[name="lga"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="lga"]').append(
                            '<option value="'+key+'">'+key+'-'+ value +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="lga"]').empty();
         }
    });
});

$(document).ready(function(){
    $('select[name="lga"]').on('change', function(){
         var lga = $(this).val();

         if (lga){
            $.ajax({
                url: '/admin/lga/fetchSectors/',
                type: 'GET',
                dataType: 'json',
                beforeSend: function () {
                    $('.spinner').show();
                },
                success: function(data){
                    $('.spinner').hide();
                     $('select[name="school_sector"]').empty();
                     $('select[name="school_sector"]').prepend(
                            '<option disabled selected value="">'+ "Please Select" +'</option>'
                            );
                     $.each(data, function(key, value){
                        $('select[name="school_sector"]').append(
                            '<option value="'+value.id+'">'+ value.title +'</option>'
                            );
                     });
                }
            });
         } else {
            $('select[name="school_sector"]').empty();
         }
    });
});

    $(document).ready(function(){
        $('select[name="school_sector"]').on('change', function(){
             var sector = $(this).val();
             var lga = $('select[name="lga"]').val();
             if (sector){
                $.ajax({
                    url: '/admin/lga/fetchSchools',
                    data: { lga: lga, sector: sector },
                    type: 'GET',
                    dataType: 'json',
                    beforeSend: function () {
                        $('.spinner').show();
                    },
                    success: function(data){
                        $('.spinner').hide();
                         $('select[name="school"]').empty();
                         $.each(data, function(key, value){
                            $('select[name="school"]').append(
                                '<option value="'+key+'">'+ value +'</option>'
                                );
                         });
                    }
                });
             } else {
                $('select[name="school"]').empty();
             }
        });
    });