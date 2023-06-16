<?php
    if(!empty($filters)){
?>
<div class="filters">
    <form id="filterForm" name="filterForm" method="post" onsubmit="update_filters(event);">
        <div class="container-fluid">
        <div class="search_us">
            <div class="row">
                <input type="hidden" name="pageNo" id="pageNo" value="0" />
                <input type="hidden" name="limit" id="limit" value="0" />
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="location">
                            <option value="">Location</option>
                            <?php
                            foreach($filters['location'] as $location){
                        ?>
                            <option value="<?=$location;?>"><?=$location;?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="position">
                            <option value="">Position</option>
                            <?php
                            foreach($filters['position'] as $position){
                        ?>
                            <option value="<?=$position;?>"><?=$position;?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="company">
                            <option value="">Company</option>
                            <?php
                            foreach($filters['company'] as $company){
                        ?>
                            <option value="<?=$company;?>"><?=$company;?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="sort_by">
                            <option value="">Sort By</option>
                            <option value="address">Location</option>
                            <option value="position">Position</option>
                            <option value="company">Company</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="sort_by_direction">
                            <option value="">Sort By Direction</option>
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="date_posted">
                            <option value="">Date Posted</option>
                            <option value="<?=date('Y-m-d', strtotime('now - 1day'));?>">Past 24 hours</option>
                            <option value="<?=date('Y-m-d', strtotime('now - 7day'));?>">Past Week</option>
                            <option value="<?=date('Y-m-d', strtotime('now - 31day'));?>">Past Month</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search_string" id="search_string"
                            placeholder="Search Position, Company or Location" />
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name="job_type">
                            <option value="">Job Type</option>
                            <option value="1">Remote</option>
                            <option value="2">Hybrid</option>
                            <option value="3">Onsite</option>
                        </select>
                    </div>
                </div>
            </div>
           
                
                <div class="searc_bbtn">
                    <button type="button" onclick="fetch_jobs();" class="btn btn_theme">Search</button>
                    <button type="button" onclick="reset_jobs();" class="btn btn_theme2">Reset</button>
                </div>
        </div>
        </div>
    </form>
</div>
<?php
    }
?>