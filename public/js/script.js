console.log('HELLO THERE!');
/*

$(document).ready(function(){
    $('.panel-header').html('SIGN IN');
});
*/

const apiUrl = "http://localhost:8090";


function getFiles(){


    const $list = $('files-list');

    $.ajax({
        url: apiUrl + '/?page=files',
        dataType: 'json'

    }).done((res) =>{

        $list.empty();
        res.forEach()(el =>{
            $list.append('<tr>
                <td> ${el.</td>

/*
            <td>${el.name}</td>
            <td>${el.surname}</td>
            <td>${el.email}</td>
            <td>${el.role}</td>*/
                <td>
            <button class="btn btn-danger" type="button" onclick="deleteFile(${el.id})">
                <i class="material-icons">Delete</i>'
            </td>
            </tr>'
        })

    });


}


function deleteFile(id){
    if(!confirm('Do you realy want to delete this file? It will be completely removed from your database forever. ')){
        return;
    }


    $.ajax({
        url: apiUrl + '/?page=delete_file',
        method : "POST" ,
        data : {
            id: id
        },
        success: function(){
            alert('Selected file was succesfully deleted from database!')
            getFiles();
        }
    })



}