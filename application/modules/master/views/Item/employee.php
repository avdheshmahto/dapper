 <?php
    //$this->load->view('templates/header');
    ?>
    <header class="page-header">
        <h1 class="entry-title">Codeigniter: Pagination Demo</h1>
    </header>
    <div class="table-responsive">
        <table class="table table-hover tablesorter">
            <thead>
                <tr>
                    <th class="header">Name</th>
                    <th class="header">Email</th>                           
                    <th class="header">Salary</th>                      
                    <th class="header">Age</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($employeeInfo) && !empty($employeeInfo)) {
                    foreach ($employeeInfo as $key => $element) {                   
                        ?>
                        <tr>
                            <td><?php echo $element['name']; ?></td>   
                            <td><?php echo $element['email']; ?></td> 
                            <td><?php echo $element['salary']; ?></td>                       
                            <td><?php echo $element['age']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="4">There is no employee.</td>    
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div> 
    <div class="clearfix mrgB"></div>
    <div class="text-right">
        <?php if (isset($employeeInfo) && is_array($employeeInfo)) echo $page_links; ?>  
    </div> 
    <footer class="entry-meta">
        <span class="edit-link">
            <a class="btn btn-primary btn-sm" href="http://techarise.com/codeigniter-pagination-demo/"><i class="fa fa-mail-reply"></i> Back To Tutorial</a>
        </span> 
    </footer>
    <?php
    //$this->load->view('templates/footer');
    ?>