<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model extends CI_Model
{
	function get($tabel)
	{
		$data = $this->db->get($tabel);
		return $data;
	}
	function swal($tipe, $titel, $value)
	{
		// download swal js. nya dulu dullu lalu pakai dengan fungsi dimodel ini untuk dipanggil dan di eksekusi pada pengkondisian di controller dan hasilnya akan ditampilkan pada view yang dituju oleh kontroller
		if ($tipe == 'error' or $tipe == 'hapus') {
			$info = `<script>swal("` . $titel . `!", "` . $value . `", "success");
        </script>`;
			$this->session->set_tempdata('info', $info, 10);
		} elseif ($tipe == 'sukses') {
			$info = '';
			$this->session->set_tempdata('info', $info, 10);
		}
	}
	function setSessionFlash($tipe, $titel)
	{

		if ($tipe == 'error' or $tipe == 'hapus') {
			$info = '
						<div class="alert alert-danger alert-dismissible">
	                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                		<h4>
	                			<i class="icon fa fa-ban">' . $tipe . '</i>!
	                		</h4> Data ' . $titel . ' 
	                	</div>';
			$this->session->set_tempdata('info', $info, 1);
		} elseif ($tipe == 'sukses') {
			$info = '
						<div class="alert alert-success alert-dismissible">
	                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                		<h4><i class="icon fa fa-ban">' . $tipe . '</i>!</h4> Data ' . $titel . ' </div>';
			$this->session->set_tempdata('info', $info, 1);
		}
	}
	function add($table, $data)
	{
		$this->db->insert($table, $data);
		$info = '<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses Ditambah </div>';
		// $this->session->set_tempdata('info', $info, 10);
	}
	function delete($table, $id, $pardb)
	{
		$this->db->where($pardb, $id);
		$this->db->delete($table);
		$info = '<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses Dihapus </div>';
		// $this->session->set_tempdata('info', $info, 10);
	}
	function getRows()
	{
		return $this->db->get('tb_menara')->result();
	}
	function getId($table, $id, $field)
	{
		return $this->db->get_where($table, array($field => $id))->result();
	}
	function getId2($table, $email)
	{
		$this->db->where('email', $email);
		return $this->db->get($table)->result();
	}
	function update($table, $id, $data, $parameter)
	{
		$this->db->where($parameter, $id);
		$this->db->update($table, $data);

		$info = '<div class="alert alert-success alert-dismissible">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	                <h4><i class="icon fa fa-ban"></i> Sukses!</h4> Data Sukses Diubah </div>';
		$this->session->set_flashdata('info', $info);
	}
	function updateuse($table, $data)
	{
		$this->db->where('email', $data['email']);
		$this->db->update($table, $data);
	}
	function updateWHERE($table, $data, $id, $value)
	{
		$this->db->where($id, $value);
		$this->db->update($table, $data);
	}
	function wereAND($tabel, $var1, $var2, $data1, $data2)
	{
		$where = "$var1 = '$data1' AND $var2 = '$data2'";
		$this->db->where($where);
		$data = $this->db->get($tabel);
		return $data;
	}
	function wereANDNOT($tabel, $var1, $var2, $var3, $data1, $data2, $data3)
	{
		$where = "$var1 = '$data1' AND $var2 != '$data2' AND $var3 != '$data3'";
		$this->db->where($where);
		$data = $this->db->get($tabel);
		return $data;
	}
	function wereandd($tabel, $var1, $data1, $var2, $data2, $var3, $data3)
	{
		$where = "$var1 = '$data1' AND $var2 = '$data2' AND $var3 = '$data3'";
		$this->db->where($where);
		$data = $this->db->get($tabel);
		return $data;
	}
	function select_disting()
	{

		$this->db->distinct();
		$this->db->order_by('sumber_data', 'DESC');
		$this->db->select('sumber_data');
		$data = $this->db->get('tb_menara');

		return $data;
	}
	function ambil_distinct($tabel, $vselect)
	{

		$this->db->distinct();
		// $this->db->order_by($vorder, $by);
		$this->db->select($vselect);
		$data = $this->db->get($tabel);

		return $data;
	}
	function select_disting_where($var1, $data1)
	{
		$where = "$var1 = '$data1'";
		$this->db->distinct();
		$this->db->order_by('sumber_data', 'DESC');
		$this->db->select('sumber_data');
		$this->db->where($where);
		$data = $this->db->get('tb_menara');

		return $data;
	}
	function cek_row_where_and($tabel, $data1, $data2, $var1, $var2)
	{
		$where = "$var1 = '$data1' AND $var2 = '$data2'";
		$this->db->where($where);
		$query = $this->db->get($tabel);

		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
	function cek_row_where($tabel, $data, $var)
	{
		$query = $this->db->get_where($tabel, array($var => $data));
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
	function cek_row($tabel)
	{
		$query = $this->db->get($tabel);
		if ($query->num_rows() > 0) {
			return $query->num_rows();
		} else {
			return 0;
		}
	}
	function getJoin($select, $tabel1, $tabel2, $onclause)
	{
		$this->db->select($select);
		$this->db->from($tabel1);
		$this->db->join($tabel2, $onclause);
		return $this->db->get();
	}
	function getJoinDisting($select, $tabel1, $tabel2, $onclause)
	{
		$this->db->distinct();
		$this->db->select($select);
		$this->db->from($tabel1);
		$this->db->join($tabel2, $onclause);
		return $this->db->get();
	}
	function getJoinWhere2($select, $tabel1, $tabel2, $onclause, $where, $tes)
	{
		$this->db->select($select);
		$this->db->from($tabel1);
		$this->db->join($tabel2, $onclause);
		$this->db->where($where, $tes);
		return $this->db->get()->result();
	}
	function getJoinWhere($select, $tabel1, $tabel2, $onclause, $where, $tes)
	{
		$this->db->select($select);
		$this->db->from($tabel1);
		$this->db->join($tabel2, $onclause);
		$this->db->where($where, $tes);
		return $this->db->get();
	}
	function getJoinWhereAnd($select, $tabel1, $tabel2, $onclause, $var1, $var2, $data1, $data2)
	{
		$where = "$var1 = '$data1' AND $var2 = '$data2'";
		$this->db->select($select);
		$this->db->from($tabel1);
		$this->db->join($tabel2, $onclause);
		$this->db->where($where);
		return $this->db->get();
	}
	function getJoinWhereId($select, $tabel1, $tabel2, $onclause, $where, $tes)
	{
		$this->db->select($select);
		$this->db->from($tabel1);
		$this->db->join($tabel2, $onclause);
		$this->db->where($where, $tes);
		return $this->db->get()->result();
	}
	function ambil_where2($tabel, $data, $var)
	{
		$data = $this->db->get_where($tabel, array($var => $data));
		return $data;
	}
	function ambil_where22($tabel, $data, $var)
	{
		$data = $this->db->get_where($tabel, array($var => $data));
		return $data->result();
	}


	// pengecekan karakter
	function cek_text($post = '', $h = '', $a = '', $s1 = '', $s2 = '', $s3 = '', $s4 = '')
	{
		// global identifier
		$huruf = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
		$angka = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
		$spesial1 = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '=', '`', '~', '{', '}', '[', ']', '|', ':', ';', '"', '<', '>', '?', '/'];
		$spesial2 = ["'"];
		$spesial3 = ["-", ",", "."];
		$spesial4 = [",", "."];

		$pesan = '';

		// ------

		if ($h != 'OK') {
			$test = false;
			foreach ($huruf as $key) {
				if (strpos($post, $key) !== false) {
					$test = true;
				}
			}
			if ($test != false) {
				$pesan = 'karakter HURUF dilarang. ' . $pesan;
			}
		}
		if ($a != 'OK') {
			$test = false;
			foreach ($angka as $key) {
				if (strpos($post, $key) !== false) {
					$test = true;
				}
			}
			if ($test != false) {
				$pesan = 'karakter angka dilarang. ' . $pesan;
			}
		}
		if ($s1 != 'OK') {
			$test = false;
			foreach ($spesial1 as $key) {
				if (strpos($post, $key) !== false) {
					$test = true;
					$s1 = 'terdeteksi';
				}
			}
			if ($test != false) {
				$pesan = 'karakter SPESIAL dilarang. ' . $pesan;
			}
		}
		if ($s2 != 'OK') {

			$test = false;
			foreach ($spesial2 as $key) {

				if (strpos($post, $key) !== false) {
					if ($s1 != 'terdeteksi') {
						// var_dump('oke cuy' . $s1);
						// die;
						$test = true;
						$s2 = 'terdeteksi';
					}
				}
			}
			if ($test != false) {
				$pesan = 'karakter SPESIAL dilarang. ' . $pesan;
			}
		}
		if ($s3 != 'OK') {
			$test = false;
			foreach ($spesial3 as $key) {
				if (strpos($post, $key) !== false) {
					if ($s1 == 'OK' and $s2 == 'OK') {
						$test = true;
					}
				}
			}
			if ($test != false) {
				$pesan = 'karakter SPESIAL dilarang. ' . $pesan;
			}
		}
		if ($s4 != 'OK') {
			$test = false;
			foreach ($spesial4 as $key) {
				if (strpos($post, $key) !== false) {
					if ($s1 == 'OK' and $s2 == 'OK' and $s3 == 'OK') {
						$test = true;
					}
				}
			}
			if ($test != false) {
				$pesan = 'karakter SPESIAL dilarang. ' . $pesan;
			}
		}
		return $pesan;
	}

	function cek_post($post = '', $tipe = 'text')
	{
		// text: memungkinkan menginputkan seluruh karakter kecuali karakter kutip, huruf:hanya huruf saja, integer: hanya positif integer, minteger: seluruh integer, float:hanya positif float, minfloat: seluruh float. 
		// global identifier
		$huruf = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', ' '];
		$angka = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
		$semua_spesial = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '=', '`', '~', '{', '}', '[', ']', '|', ':', ';', '<', '>', '?', '/', "'", ',', '.', '-'];
		$spesial = ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '=', '`', '~', '{', '}', '[', ']', '|', ':', ';', '<', '>', '?', '/', "'"];
		$kutip = ["'", '`', '"', '~'];
		$float = [",", "."];
		$minus = ["-"];

		$pesan = '';

		if ($post != null and $post != '') {
			if ($tipe == 'text') {
				$test = false;
				// karakter kutip
				foreach ($kutip as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}

				if ($test == true) {
					$pesan = 'Karakter Spesial Dilarang. ' . $pesan;
					$test = false;
				}
			} elseif ($tipe == 'huruf') {
				$test = false;
				// start spesial
				// karakter kutip
				foreach ($kutip as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				// karakter spesial1
				foreach ($semua_spesial as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Spesial Dilarang. ' . $pesan;
					$test = false;
				}
				// end spesial

				// start angka
				foreach ($angka as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Angka Dilarang. ' . $pesan;
					$test = false;
				}
				// end angka
			} elseif ($tipe == 'integer') {
				$test = false;
				// start spesial
				// karakter spesial1
				foreach ($semua_spesial as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Spesial Dilarang. ' . $pesan;
					$test = false;
				}
				// end spesial

				// start huruf
				foreach ($huruf as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Huruf/Spasi Dilarang. ' . $pesan;
					$test = false;
				}
				// end huruf
			} elseif ($tipe == 'minteger') {
				$test = false;
				// start spesial
				// karakter spesial1
				foreach ($spesial as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				foreach ($float as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Spesial Dilarang. ' . $pesan;
					$test = false;
				}
				// end spesial

				// cek letak min
				if (strpos($post, '-') !== 0) {
					$test = true;
				}
				// cek duplikasi min
				if (substr_count($post, '-') > 1) {
					$test = true;
				}
				if ($test == true) {
					$pesan = 'Format Angka Salah. ' . $pesan;
					$test = false;
				}

				// start huruf
				foreach ($huruf as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Huruf/Spasi Dilarang. ' . $pesan;
					$test = false;
				}
				// end huruf
			} elseif ($tipe == 'float') {
				$test = false;
				// start spesial
				// karakter spesial1
				foreach ($spesial as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				foreach ($minus as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Spesial Dilarang. ' . $pesan;
					$test = false;
				}
				// end spesial

				// start huruf
				foreach ($huruf as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Huruf/Spasi Dilarang. ' . $pesan;
					$test = false;
				}
				// end huruf

				// cek letak min
				foreach ($float as $key) {
					if (strpos($post, $key) === 0) {
						$test = true;
					}
					// cek duplikasi min
					if (substr_count($post, $key) > 1) {
						$test = true;
					}
				}

				if ($test == true) {
					$pesan = 'Format Angka Salah. ' . $pesan;
					$test = false;
				}
			} elseif ($tipe == 'minfloat') {
				$test = false;
				// start spesial
				// karakter spesial1
				foreach ($spesial as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Spesial Dilarang. ' . $pesan;
					$test = false;
				}
				// end spesial

				// start huruf
				foreach ($huruf as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Huruf/Spasi Dilarang. ' . $pesan;
					$test = false;
				}
				// end huruf

				// cek letak min
				if (strpos($post, '-') != 0) {

					$test = true;
				}

				if (strpos($post, '-') !== false) {
					// cek letak min
					foreach ($float as $key) {
						if (strpos($post, $key)  === 0 or strpos($post, $key)  === 1) {

							$test = true;
						}
						// cek duplikasi min
						if (substr_count($post, $key) > 1) {
							$test = true;
						}
					}
				} else {
					// cek letak koma
					foreach ($float as $key) {
						if (strpos($post, $key) === 0) {
							// var_dump(strpos($post, $key));
							$test = true;
						}
						// cek duplikasi min
						if (substr_count($post, $key) > 1) {
							$test = true;
						}
					}
				}
				// cek duplikasi min
				if (substr_count($post, '-') > 1) {
					$test = true;
				}
				if ($test == true) {
					$pesan = 'Format Angka Salah. ' . $pesan;
					$test = false;
				}
			} elseif ($tipe == 'hurang') {
				$test = false;
				// start spesial
				// karakter spesial1
				foreach ($semua_spesial as $key) {
					if (strpos($post, $key) !== false) {
						$test = true;
					}
				}
				if ($test == true) {
					$pesan = 'Karakter Spesial Dilarang. ' . $pesan;
					$test = false;
				}
				// end spesial
			}
		} else {
			$pesan = 'galat';
		}
		// ------

		return $pesan;
	}
}
