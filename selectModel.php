<style>
  .selectable-card {
    cursor: pointer;
    transition: transform 0.2s;
  }

  .selectable-card:hover {
    transform: scale(1.05);
  }

  .selectable-card.selected {
    border: 2px solid #007bff;
    background-color: #e7f3ff;
  }

  .font {
    font-size: 20px;
  }
</style>

<div style="z-index: 9999;" class="modal fade " id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Enter the recipient's email</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container mt-1">
          <div class="row">
            <div class="col-md-12 mb-5">
              <label>The recipient's email</label>
              <input type="text" class="form-control" id="email">
            </div>
          </div>
        </div>
        <div class="col-md-12">
              <div class="card selectable-card border" onclick="selectCard(this)">
                <div class="card-body">
                <p class="card-text font">Option 1</p>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card selectable-card border" onclick="selectCard(this)">
                <div class="card-body">
                <p class="card-text font">Option 2</p>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card selectable-card border" onclick="selectCard(this)">
                <div class="card-body">
                  <p class="card-text font">Option 3</p>
                </div>
              </div>
            </div>

      </div>
      <div class="modal-footer align-items-center d-flex">
        <button class="btn btn-secondary col-5" onclick="buyNow();">Continue Payment</button>
      </div>
    </div>
  </div>
</div>
<div style="z-index: 9999;" class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Add Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" placeholder="example@gmail.com">
          </div>

          <div class="col-6 mb-3">
            <label class="form-label">Mobile Number</label>
            <input type="text" class="form-control" placeholder="0712345678">
          </div>
          <div class="col-6 mb-3">
            <label class="form-label">Country</label>
            <select class="form-control">
              <option>Srilanka</option>
            </select>
          </div>

          <div class="col-6 mb-3">
            <label class="form-label">Province</label>
            <select class="form-control">
              <option>Western</option>
            </select>
          </div>
          <div class="col-12 mb-3">
            <label class="form-label">State</label>
            <input type="text" class="form-control">
          </div>
          <div class="col-12 mb-3">
            <label class="form-label">District</label>
            <select class="form-control">
              <option>Colombo</option>
            </select>
          </div>
          <div class="col-12 mb-3">
            <label class="form-label">Zip Code</label>
            <input type="text" class="form-control">
          </div>
        </div>

        <label for="address1" class="my-2 form-label">Address Line 1:</label>
        <input type="text" class="form-control">
        <label for="address1" class="my-2 form-label">Address Line 2:</label>
        <input type="text" class="form-control">
        <div class="alert alert-success mt-2" role="alert">
          Your New Address successfully added check the option 1 in select address tab. Now you can close this model and continue your Payment Process.
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-dark">Add Address</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>
<script>
  let selectedCard = null;

  function selectCard(card) {
    if (selectedCard) {
      selectedCard.classList.remove('selected');
    }
    selectedCard = card;
    selectedCard.classList.add('selected');
  }
</script>