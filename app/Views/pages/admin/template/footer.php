	</div>
	</div>
	</div>

	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin meninggalkan halaman ini?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Pilih 'Logout' di bawah jika anda siap mengakhiri sesi saat ini.</div>
				<div class="modal-footer">
					<button class="btn btn-warning" type="button" data-dismiss="modal"><i class="fas fa-fw fa-times mr-1"></i>Batal</button>
					<a class="btn btn-danger" href="<? base_url('/logout') ?>"><i class="fas fa-fw fa-sign-out-alt mr-1"></i>Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url('admin//vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url('admin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url('admin/js/sb-admin-2.min.js') ?>"></script>

	<!-- Page level plugins -->
	<script src="<?= base_url('admin/vendor/chart.js/Chart.min.js') ?>"></script>

	<!-- Page level plugins -->
	<script src="<?= base_url('admin/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('admin/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

	<!-- Page level custom scripts -->
	<script src="<?= base_url('admin/js/demo/datatables-demo.js') ?>"></script>

	<script>
		$(function() {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
	<script>
		document.querySelectorAll('.custom-file-input').forEach(function(input) {
			input.addEventListener('change', function(e) {
				const fileName = e.target.files[0].name;
				e.target.nextElementSibling.innerText = fileName;
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			let checkboxes = document.querySelectorAll(".form-check-input");
			checkboxes.forEach(function(checkbox) {
				checkbox.addEventListener("change", function() {
					let jamInput = this.closest(".form-check").querySelector(".jam-input");
					jamInput.style.display = this.checked ? "flex" : "none";
				});
			});
		});
	</script>

	</body>

	</html>