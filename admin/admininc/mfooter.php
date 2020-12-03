<footer class="footer footer-black  footer-white ">
    <div class="container-fluid">
        <div class="row">
            <nav class="footer-nav">
                <ul>
                    <!-- <li>
                        <a href="./" target="_blank">Home</a>
                    </li>
                    <li>
                        <a href="mdashboard" target="_blank">Dashboard</a>
                    </li> -->
                    <li>
                        <a href="logout/<?= $_SESSION['adminLogin']['admin_id']; ?>">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</footer>
<!-- Core Js  -->
<script src="adminjs/jquery-3.4.1.min.js"></script>
<script src="adminjs/popper.min.js"></script>
<script src="adminjs/bootstrap.min.js"></script>
<script src="adminjs/perfect-scrollbar.jquery.min.js"></script>
<script src="adminjs/moment.min.js"></script>
<script src="adminjs/sweetalert2.min.js"></script>
<script src="adminjs/bootstrap-selectpicker.js"></script>
<script src="adminjs/jquery.dataTables.min.js"></script>
<script src="adminjs/bootstrap-datetimepicker.js"></script>
<script src="adminjs/jquery.bootstrap-wizard.js"></script>
<script src="adminjs/jasny-bootstrap.min.js"></script>
<script src="adminjs/bootstrap-notify.js"></script>
<script src="adminjs/jquery.validate.min.js"></script>
<script src="adminjs/serialObject.js"></script>
<script src="adminjs/paper-dashboard.min790f.js?v=2.0.1"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            },
            bSort:false
        });
    });
</script>

</div>
</div>
</body>
</html>
