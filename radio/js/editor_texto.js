
            $(document).ready(function() {
                  $('.summernote').summernote(
                                {lang: 'es-ES',
                                placeholder: 'Escriba aqui...',
                                disableDragAndDrop: true,
                                toolbar: [
                                // [groupName, [list of button]]
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                ['font', ['fontname','color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['misc', ['undo','redo']]
                                ]
                               });
                });