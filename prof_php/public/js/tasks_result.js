$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function show_data(num)
{
    /*let timezone =  Intl.DateTimeFormat().resolvedOptions().timeZone ;
        let today = new Date();
        let today1 = today.toLocaleString( 'en-US' , {timeZone: timezone});

        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0');
        let yyyy = today.getFullYear();

        let today_date = yyyy + '-' + mm + '-' + dd;
       */
        $.ajax({

            type:'POST',
                url:url + '/tasks_result',
                data:{task_number : num},
                cache: false,
                success:function(data){
                    document.getElementById('degree').style.display = "block";
                    document.getElementById('degree').innerHTML = data;
                }
            });
            
}
    $(".task_1").click(function(e){

        let timezone =  Intl.DateTimeFormat().resolvedOptions().timeZone ;
        let today = new Date();
        let today1 = today.toLocaleString( 'en-US' , {timeZone: timezone});

        let dd = String(today.getDate()).padStart(2, '0');
        let mm = String(today.getMonth() + 1).padStart(2, '0');
        let yyyy = today.getFullYear();

        let today_date = yyyy + '-' + mm + '-' + dd;
        e.preventDefault();
        $.ajax({

            type:'POST',
                url:url + '/create_system',
                data:{task_number : "1" , recive_date : today_date},
                cache: false,
                success:function(data){
                    window.location.assign(url + "/add_info");
                }
            });
    });