<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        #files-area {
            width: 30%;
            margin: 0 auto;
        }

        .file-block {
            border-radius: 10px;
            background-color: rgba(144, 163, 203, 0.2);
            margin: 5px;
            color: initial;
            display: inline-flex;

            &>span.name {
                padding-right: 10px;
                width: max-content;
                display: inline-flex;
            }
        }

        .file-delete {
            display: flex;
            width: 24px;
            color: initial;
            background-color: #6eb4ff00;
            font-size: large;
            justify-content: center;
            margin-right: 3px;
            cursor: pointer;

            &:hover {
                background-color: rgba(144, 163, 203, 0.2);
                border-radius: 10px;
            }

            &>span {
                transform: rotate(45deg);
            }
        }
    </style>
</head>

<body>
    <p class="mt-5 text-center">
        <label for="attachment">
            <a class="btn btn-primary text-light" role="button" aria-disabled="false">+ Add</a>

        </label>
        <input type="file" name="file[]" id="attachment" multiple />

    </p>
    <p id="files-area">
        <span id="filesList">
            <span id="files-names"></span>
        </span>
    </p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

        $("#attachment").on('change', function(e) {
            for (var i = 0; i < this.files.length; i++) {
                
                let fileBloc = $('<span/>', {
                        class: 'file-block'
                    }),
                    fileName = $('<span/>', {
                        class: 'name',
                        text: this.files.item(i).name
                    });


                fileBloc.append('<span class="file-delete"><span>+</span></span>')
                   .append(fileName);
                $("#filesList > #files-names").append(fileBloc);


            };


            // Ajout des fichiers dans l'objet DataTransfer
            for (let file of this.files) {
                dt.items.add(file);
            }
            // Mise à jour des fichiers de l'input file après ajout
            this.files = dt.files;

            console.log(dt.items);
            // EventListener pour le bouton de suppression créé
            $('span.file-delete').click(function() {
                let name = $(this).next('span.name').text();
                console.log(name);
                // Supprimer l'affichage du nom de fichier
                $(this).parent().remove();
                for (let i = 0; i < dt.items.length; i++) {
                    // Correspondance du fichier et du nom
                    if (name === dt.items[i].getAsFile().name) {
                        // Suppression du fichier dans l'objet DataTransfer
                        dt.items.remove(i);
                        continue;
                    }
                }
                // Mise à jour des fichiers de l'input file après suppression
                document.getElementById('attachment').files = dt.files;
            });
        });
    </script>
</body>

</html>