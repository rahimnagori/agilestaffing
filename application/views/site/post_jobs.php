

<div class="sign_up">

  <div class="container">

    <div class="row">

      <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

        <div class="sign_box">

           <h3 class="top_ster">

            Post Jobs

             <span>What job do you want to post?</span>

           </h3>

            <form>

              <div class="rangebar">

            <div class="procccs1">

              <div class="procccs2"></div>

            </div>

            <div class="row">

              <a href="#" class="col-xs-4 text-center active">

                <div class="icon_si1">

                  <i class="fa fa-briefcase"></i>

                </div>

                <h4>STEP 1</h4>

              </a>

              <a href="#" class="col-xs-4 text-center">

                <div class="icon_si1">

                  <i class="fa fa-file-text-o"></i>

                </div>

                <h4>STEP 2</h4>

              </a>

              <a href="#" class="col-xs-4 text-center">

                <div class="icon_si1">

                  <i class="fa fa-credit-card"></i>

                </div>

                <h4>STEP 3</h4>

              </a>

            </div>

           </div>



           <div class="row">

             <div class="col-sm-4">

               <div class="form-group">

                  <label>Company Name</label>

             <input name="" placeholder="Company Name " class="form-control" type="text">

               </div>

             </div>

             <div class="col-sm-4">

               <div class="form-group">

                  <label>Job title</label>

             <input name="" placeholder="Job title" class="form-control" type="text">

               </div>

             </div>

             <div class="col-sm-4">

               <div class="form-group">

                  <label>Location</label>

             <input name="" placeholder="Location" class="form-control" type="text">

               </div>

             </div>

           </div>

           <div class="row">

             <div class="col-sm-6">

               <div class="form-group Job_function">

                <label>Job function</label>

                  <div id="output"></div>



  <select data-placeholder="Job function" name="tags[]" multiple class="chosen-select">

    <option value="Business Development">Business Development</option>

    <option value="Software Development">Software Development</option>

    <option value="Information Technology">Information Technology</option>

    <option value="Art/Creative">Art/Creative</option>

    <option value="Design">Design</option>

    <option value="Consulting">Consulting</option>

  </select>

               </div>

             </div>

             <div class="col-sm-6">

               <div class="form-group">

                <label>Job Types</label>

                 <select class="form-control">

                   <option>Job Types</option>

                    <option value="FULL_TIME" data-test-select-option="">

        Full-time

    </option>

    <option value="PART_TIME" data-test-select-option="">

        Part-time

    </option>

    <option value="CONTRACT" data-test-select-option="">

        Contract

    </option>

    <option value="TEMPORARY" data-test-select-option="">

        Temporary

    </option>

    <option value="VOLUNTEER" data-test-select-option="">

        Volunteer

    </option>

    <option value="INTERNSHIP" data-test-select-option="">

        Internship

    </option>

                 </select>

               </div>

             </div>

           </div>

           <div class="form-group">

            <label>Job description</label>

             <textarea placeholder="Job description" class="form-control" style="height: 120px;"></textarea>

           </div>

          

           

           <div class="form-group">

            <label>Company Email</label>

             <input type="text" name="" placeholder="Company Email" class="form-control">

           </div>

           <div class="form-group">

            <label>Company Phone</label>

             <input type="text" name="" placeholder="Company Phone" class="form-control">

           </div>

           <div class="row">

             <div class="col-sm-8">

              <div class="form-group">

                <label>Salary Range</label>

                <div class="type_job">

                  <div class="slider-range132">

                    <input class="amount222" type="text" id="amount2" readonly>

        <div id="slider-range2"></div>

      

      </div>

                </div>

              </div>

              

               

             </div>

             

           </div>



           <div class="form-group btn_next text-right">

             <a href="<?= site_url('Post_Jobs2'); ?>" class="btn btn_theme">NEXT</a>

           </div>

            </form>

        </div>

      </div>

    </div>

  </div>

</div>


