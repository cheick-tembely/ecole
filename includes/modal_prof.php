<div class="modal fade" id="customerModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enregistrez une Fiches de pointage</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form role="form" method="post" action="fiche_transac.php?action=add">
                          <div class="form-group">
                              <input class="form-control" placeholder="Professeur" name="professeur" required>
                            </div>
                            <div class="form-group">
                              <input type="date" class="form-control" placeholder="Date" name="dates" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Classe" name="classe" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Matière" name="matiere" required>
                            </div>
                            <div class="form-group">
                              <input type="time" class="form-control" placeholder="Debut" name="debut" required>
                            </div>
                             <div class="form-group">
                              <input type="time" class="form-control" placeholder="Fin" name="fin" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Observation" name="observation" required>
                            </div>
                          
                            
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Envoyez</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Effacez</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annulez</button>      
          </form>  
        </div>