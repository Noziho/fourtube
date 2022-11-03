<div>
    <fieldset>
        <form action="/?c=video&a=add-video" method="post" enctype="multipart/form-data">
            <div>
                <label for="title">Titre: </label>
                <input id="title" type="text" name="title" placeholder="Titre de la vidéo ..." required minlength="8" maxlength="30">
            </div>

            <div class="margin_div_form">
                <label for="description">Description: </label>
                <input id="description" type="text" name="description" placeholder="Description" required minlength="8" maxlength="30">
            </div>

            <div class="margin_div_form">
                <input id="userVideoFile" type="file" name="userVideoFile" placeholder="Cliquez pour upload votre vidéo !" required>
            </div>

            <div class="margin_div_form button_container">
                <button id="login_button" name="submit">Upload</button>
            </div>

        </form>
    </fieldset>
</div>