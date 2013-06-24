
$(document).ready(function(){
    confirmDelete.initModal();
});


function submitGalleryPictureForm(elem) {
    var form = $(elem).closest('form');
    var action = form.attr('action');
    var data = form.serialize();

    $.ajax({
      type: "POST",
      url: action,
      data: data
    });
}


var confirmDelete = {
    modalWindow : $('<div class="modal hide fade" role="dialog" id="confirmDeleteModal">'
                        + '<div class="modal-body"><p id="confirmDeleteModalText">Delete</p></div>'
                        + '<div class="modal-footer">'
                        + '<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>'
                        + '<button class="btn btn-danger" onclick="confirmDelete.doAction();" data-dismiss="modal" aria-hidden="true"><i class="icon-trash icon-white"></i></button>'
                        + '</div>'
                        + '</div>'),

    modalActionUri : '',

    modalSubmitForm : null,

    modalRemoveObject : null,

    initModal : function() {
        $("body").append(this.modalWindow);
    },

    showModal : function(text, actionUri, submitForm, removeObject) {
        this.modalActionUri = actionUri;
        this.modalSubmitForm = submitForm;
        this.modalRemoveObject = removeObject;
        $("#confirmDeleteModalText").html(text);
        $("#confirmDeleteModal").modal();
    },

    doAction : function() {
        if(this.modalActionUri == '' && this.modalSubmitForm != null) {
            var action = this.modalSubmitForm.attr('action');
            var data = this.modalSubmitForm.serialize();
            $.ajax({
              type: "POST",
              url: action,
              data: data
            });

            if(this.modalRemoveObject != null) {
                this.modalRemoveObject.remove();
            }

        } else {
            document.location.href = this.modalActionUri;
        }
        this.modalActionUri = '';
        this.modalSubmitForm = false;
        this.modalRemoveObject = null;
    }
}

function pictureViewArrowKeys() {
    $(document).keydown(function(e){
        if (e.keyCode == 37) { // left
            document.location.href = $("a.linkPrevious").attr('href');
            return false;
        }
        if (e.keyCode == 39) { // right
            document.location.href = $("a.linkNext").attr('href');
            return false;
        }
    });
}

function pictureViewResizeFunction(elem) {
    var winWidth = $(window).width();
    var winHeight = $(window).height();
    var elemHeight = 0;

    if(winWidth < 980) { // mobil
        elemHeight = winHeight - 40;
    } else { // desktop
        elemHeight = winHeight - 200;
    }
    elem.css('height' , elemHeight + 'px');
    elem.css('max-height' , elemHeight + 'px');
}

function pictureViewAutoResize(elem) {
    pictureViewResizeFunction(elem);
    $(window).resize(function(){
        pictureViewResizeFunction(elem);
    });
}
