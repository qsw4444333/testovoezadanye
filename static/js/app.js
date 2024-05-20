var isNewNote = true;
var activeNoteID = -1;
var dataToSend = {"title": "",
                  "content": ""};
        

function notification(type, text){
    if (type == "suc"){
        $("#notification-icon-err").css({"display": "none"});
        $("#notification-icon-suc").css({"display": "block"});
    }
    else if (type == "err"){
        $("#notification-icon-suc").css({"display": "none"});
        $("#notification-icon-err").css({"display": "block"});
    }
    else{
        return;
    }

    $(".notification-right span").text(text);
    $(".notification-block").css({"opacity": "1"});

    setTimeout(function(){
        $(".notification-block").css({"opacity": "0"});
    }, 3000);
}

function fillWorkSpace(name, content){
    $("#note-name").val(name);
    $("#note-content").val(content);
}

function checkInputValues(){
    let name = $("#note-name").val();
    let content = $("#note-content").val();

    if (name.length == 0){
        return "Заполните поле с названием заметки!"
    }
    if (name.length > 30){
        return "Длина названия должна быть не более 30 символов!";
    }
    if (content.length > 4000){
        return "В заметке не может быть более 4000 символов!"
    }

    dataToSend["title"] = name;
    dataToSend["content"] = content;

    return true;
}

function createNoteBlock(id, title){
    $(".notes-blocks").append($(`<div class="note-block"  note-id="${id}"><span>${title}</span></div>`));
    $(".note-block").click(function(){
        if ($(this).hasClass("note-craete-block")){
            fillWorkSpace("", "");
            $(".note-active-block").removeClass("note-active-block");
            isNewNote = true;
            activeNoteID = -1;
            return;
        }        

        isNewNote = false;
        let noteID = Number($(this).attr("note-id"));
        let noteName = $($(this).find("span")).text();

        activeNoteID = noteID;

        if ($(".note-active-block").length > 0){
            $(".note-active-block").removeClass("note-active-block");
        }

        $(this).addClass("note-active-block");

        $.ajax({
            url: '/web.php',
            method: 'GET',
            data: {"id": noteID},
            success: function(data){ 
                let note = JSON.parse(data);
                activeNoteID = note["id"];
                fillWorkSpace(note["title"], note["content"]);
                notification("suc", `Заявка ${note["title"]} успешно получена!`);
            },
            error: function(data){
                notification("suc", `При получении заявки ${noteName} произошла ошибка, попробуйте позже!`);
            }
        });
    });
}

function deleteNoteBlock(id){
    $(`.note-block[note-id="${id}"]`).remove();
}

function editNoteBlock(id, title){
    $(`.note-block[note-id="${id}"] span`).text(title);
}


$(document).ready(function(){
    $(".note-block").click(function(){
        if ($(this).hasClass("note-craete-block")){
            fillWorkSpace("", "");
            $(".note-active-block").removeClass("note-active-block");
            isNewNote = true;
            activeNoteID = -1;
            return;
        }        

        isNewNote = false;
        let noteID = Number($(this).attr("note-id"));
        let noteName = $($(this).find("span")).text();

        activeNoteID = noteID;

        if ($(".note-active-block").length > 0){
            $(".note-active-block").removeClass("note-active-block");
        }

        $(this).addClass("note-active-block");

        $.ajax({
            url: '/web.php',
            method: 'GET',
            data: {"id": noteID},
            success: function(data){ 
                let note = JSON.parse(data);
                activeNoteID = note["id"];
                fillWorkSpace(note["title"], note["content"]);
                notification("suc", `Заявка ${note["title"]} успешно получена!`);
            },
            error: function(data){
                notification("suc", `При получении заявки ${noteName} произошла ошибка, попробуйте позже!`);
            }
        });
    });

    $("#action-s").click(function(){
        let resultCheck = checkInputValues();
        if (resultCheck == true){
            if (isNewNote){
                $.ajax({
                    url: '/web.php',
                    method: 'POST',
                    data: dataToSend,
                    success: function(data){ 
                        let note = JSON.parse(data);
                        createNoteBlock(note["id"], note["title"]);
                        notification("suc", `Заметка успешно создана!`);
                    },
                    error: function(data){
                        notification("suc", `При создании заметки произошла ошибка, попробуйте позже!`);
                    }
                });
            }
            else{
                $.ajax({
                    url: `/web.php?id=${activeNoteID}`,
                    method: 'PUT',
                    data: dataToSend,
                    success: function(data){ 
                        editNoteBlock(activeNoteID, dataToSend["title"])
                        notification("suc", `Заметка успешно отредактирована!`);
                    },
                    error: function(data){
                        notification("suc", `При редактировании заметки произошла ошибка, попробуйте позже!`);
                    }
                });
            }
        }
        notification("err", resultCheck);
    });

    $("#action-d").click(function(){
        if (activeNoteID == -1){
            return;
        }
        deleteNoteBlock(activeNoteID);
        $.ajax({
            url: `/web.php?id=${activeNoteID}`,
            method: 'DELETE',
            success: function(data){ 
                notification("suc", `Заявка успешно удалена!`);
            },
            error: function(data){
                notification("suc", `При удалении заявки произошла ошибка, попробуйте позже!`);
            }
        });
    });

});
