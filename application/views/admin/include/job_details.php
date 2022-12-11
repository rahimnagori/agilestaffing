<div class="optio_raddipo">
  <div class="form-group">
    <label> Title </label>
    <input type="text" name="title" class="form-control" required="" value="<?= $jobDetails['title']; ?>">
    <input type="hidden" name="job_id" required="" value="<?= $jobDetails['id']; ?>">
  </div>
  <div class="form-group">
    <label> Description </label>
    <textarea class="form-control textarea-edit" name="description" required=""><?= $jobDetails['description']; ?></textarea>
  </div>
  <div class="form-group">
    <label> Position </label>
    <input type="text" name="position" class="form-control" required="" value="<?= $jobDetails['position']; ?>">
  </div>
  <div class="form-group">
    <label> Job Mode </label>
    <select name="job_mode" class="form-control" required="">
      <option value="1" <?= ($jobDetails['job_mode'] == 1) ? 'selected' : ''; ?> >Remote</option>
      <option value="2" <?= ($jobDetails['job_mode'] == 2) ? 'selected' : ''; ?> >Hybrid</option>
      <option value="3" <?= ($jobDetails['job_mode'] == 3) ? 'selected' : ''; ?> >Onsite</option>
    </select>
  </div>
  <div class="form-group">
    <label> Company </label>
    <input type="text" name="company" class="form-control" required="" value="<?= $jobDetails['company']; ?>">
  </div>
  <div class="form-group">
    <label> Address </label>
    <input type="text" name="address" class="form-control" required="" value="<?= $jobDetails['address']; ?>">
  </div>
  <div class="form-group">
    <label> Salary </label>
    <input type="number" name="salary" class="form-control" required="" value="<?= $jobDetails['salary']; ?>">
  </div>
  <div class="form-group">
    <label> Last Date </label>
    <input type="date" name="last_date" class="form-control" required="" value="<?= date("Y-m-d", strtotime($jobDetails['last_date'])); ?>">
  </div>
  <div class="row">
    <div class="col-sm-12" class="responseMessage" id="editResponseMessage"></div>
  </div>
  <div class="form-group">
    <button class="btn btn_theme2 btn-lg btn_submit">Update</button>
  </div>
</div>