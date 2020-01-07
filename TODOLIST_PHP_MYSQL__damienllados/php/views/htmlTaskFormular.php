<div class="container global">
            <h5 class="small-marge">Ajouter une tache :</h5>
            <div id="formulaire" class="jumbotron small-marge">
                <form method="post" action='?action=addTask'>
                    <div class="form-group">
                        <input name="createTitle" type="text" class="form-control" id="titleTask" placeholder="Titre de la tache"></input>
                    </div>
                    <div class="form-group">
                        <textarea name="createDesc" class="form-control" id="descriptionTask" rows="3" placeholder="Description de la tache"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter la tache</button>
                </form>
            </div>