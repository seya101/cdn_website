<!-- MODAL -->
<div id="btnReplace" class="modal">

  <div class="modal-dialog modal-lg" role="document">

    <!-- Modal Content -->
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">

        <h4 class="modal-title">Replace Image File</h4>

        <button type="button" class="close text-secondary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

      </div>

      <!-- Modal Body -->
      <div class="modal-body">

        <h6>Please insert the image you want to upload</h6>

        <form action="assets/includes/replace.php" method="POST" enctype="multipart/form-data">

          <div class="form-group" style="padding:10px;margin:0px;">

              <!-- Replace -->
              <div class="form-row">

                  <div class="col" style="padding:5px;">

                      <input class="form-control" id="img" type="file" name="img" multiple accept=".jpg, .png, .gif" />
                                 
                        <select class="watermark-select form-control"  name="image_upload" required="">

                          <option value="">Select site watermark</option>

                          <option value="none">None</option>

                          <option value="mt-keeper">Mt-Keeper</option>

                          <option value="freeworld">Freeworld</option>

                          <option value="agora">Mt-Agora</option>

                          <option value="totoroom1">Totoroom1</option>

                          <option value="hubl001">Hubl001</option>

                          <option value="hubl003">Hubl003</option>

                          <option value="hubl004">Hubl004</option>

                          <option value="hubl005">Hubl005</option>

                          <option value="moamoa1">Moamoa1</option>

                          <option value="hub01net">Hub-01</option>

                        </select>

                  </div>
              </div>
                            
          </div>
                    
      </div>

      <div class="modal-footer">

        <!-- Replace Btn -->
       <input type="submit" name="replace" id="insert" value="Replace" class="btn btn-secondary font-weight-bold" />

        <!-- Cnacel Btn -->
        <button type="button" class="btn btn-danger" data-dismiss="alert" aria-label="Close" >Cancel</button>

      </div>

      </form>

    </div>

  </div>

</div>

