<div class="desboard_m">
    <div class="container-fluid">
        <div class="row row_sp1">
            <div class="col-sm-3">
                <?php include 'include/sidebar.php'; ?>
            </div>
            <div class="col-sm-9">
                <div class="right_side">
                    <h2>Past Applications</h2>
                    <div class="set_whight">
                        <div class="table-responsive">
                            <table id="extent_tbl1" class="table display tabel_me">
                                <thead>
                                    <tr>
                                        <th>Job</th>
                                        <th>Applied On</th>
                                        <th>Position</th>
                                        <th>Company</th>
                                        <th>Address</th>
                                        <th>Salary</th>
                                        <th>Last Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($jobApplications as $jobApplication) {
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url('Search-Jobs'); ?>"
                                                    target="_blank"><?= $jobApplication['title']; ?></a>
                                            </td>
                                            <td>
                                                <?= date("d M Y", strtotime($jobApplication['created'])); ?>
                                            </td>
                                            <td>
                                                <?= $jobApplication['position']; ?>
                                            </td>
                                            <td>
                                                <?= $jobApplication['company']; ?>
                                            </td>
                                            <td>
                                                <?= $jobApplication['address']; ?>
                                            </td>
                                            <td>
                                                <?= $jobApplication['salary']; ?>
                                            </td>
                                            <td>
                                                <?= date("d M Y", strtotime($jobApplication['last_date'])); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>