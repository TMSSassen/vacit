$(document).ready(function () {
    $('#sol_table').DataTable();
    $('.uitnodigbaar').click(nodigUitHandler);
    setTimeOut(checkUpdates,3000);
});

function nodigUitHandler(evt){
    $.ajax('/bedrijf/sollicitatie/nodiguit/',{
        "method":"POST",
        "data":{
            "token":$('#csrf-token').data('token'),
            "id":$(evt).data('id')
        }
    });
}

function checkUpdates(){
    let toCheck=$('.checkUitnodigStatus');
    if(toCheck.size()<1){
        return;
    }
    $.ajax('/kandidaat/sollicitatie/checkUitnodiging/',{
        "success":handleUpdates,
        "dataType":"json"
    });
}
function handleUpdates(data){
    if(!data.success){
        return;
    }
    let uitgenodigd=data.uitgenodigd;
    for(id in uitgenodigd)
    {
        let cell = $("#sol"+id);
        cell.text('yes');
        cell.removeClass('uitnodigdbaar');
    }
    setTimeOut(checkUpdates,3000);    
}
