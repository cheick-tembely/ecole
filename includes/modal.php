
  <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enregistrez un étudiant</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="etudiant_transac.php?action=add">
                    <div class="form-group">
                        <input class="form-control" placeholder="Nom Étudiant" name="nom" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Prénom Étudiant" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Téléphone Étudiant" name="telephone" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Nom du Tuteur" name="nom_tuteur" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Prénom du Tuteur" name="prenom_tuteur" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Téléphone du Tuteur" name="telephone_tuteur" required>
                   
                    <div class="form-group">
                        <select class="form-control" name="sexe" required>
                            <option value="">Sélectionnez le sexe</option>
                            <option value="Garçon">Garçon</option>
                            <option value="Fille">Fille</option>
                        </select>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i> Envoyer</button>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i> Effacer</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>


  <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Matière</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="matiere_transac.php?action=add">
                            
                            <div class="form-group">
                              <input class="form-control" placeholder="Matiere" name="libelle_matiere" required>
                            </div>
                         
                          
             
           
            
              <hr>
              <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>       
          </form>  
        </div>
      </div>
    </div>
  </div>



  <!-- Delete Modal-->
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmez la suppression</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Voulez-vous vraiment supprimez?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>
          <a class="btn btn-danger btn-ok">supprimez</a>
        </div>
      </div>
    </div>
  </div>
  
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    