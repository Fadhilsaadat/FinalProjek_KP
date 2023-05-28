<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pengajuan;
use CodeIgniter\Database\Query;
use CodeIgniter\Email\Email;

class PengajuanController extends BaseController
{
    protected $mRequest;

    public function __construct()
    {
        $this->mRequest = service("request");
    }

    public function index()
    {
        // dd(user()->id);
        $data['title'] = 'Pengajuan';
        $model = new Pengajuan();
        $where = "";
        if (in_groups("user")) {
            $where = "WHERE p.user_id='" . user()->id . "'";
        }
        // dd($where);
        $data['pengajuan'] = $this->db->query("SELECT *
        FROM pengajuan p
        $where")->getResultArray();
        // $data['pengajuan'] = $model->orderBy('hari_tanggal', 'DESC')->findAll();

        return view('pengajuan/index', $data);
    }

    public function create()
    {
        $tempatOptions = [
            'Ruang Spare Room 1',
            'Ruang Spare Room 2',
            'Atrium SD', 
            'Kelas X.1', 
            'Kelas X.2', 
            'Kelas X.3', 
            'Kelas X.4',
            'Kelas X.5', 
            'Kelas X.6', 
            'Kelas X.7', 
            'Kelas XI.1', 
            'Kelas XI.2', 
            'Kelas XI.3',
            'Kelas XI.4', 
            'Kelas XI.5',
            'Kelas XI.6',
            'Kelas XI.7', 
            'Kelas XII.1', 
            'Kelas XII.2', 
            'Kelas XII.3', 
            'Kelas XII.4',
            'Kelas XII.5',
            'Kelas XII.6',
            'Kelas XII.7',
            'Teater',
            'Ruang OSIS/Wakasis',
            'Ruang Laboratorium',
            'Laboratorium Kimia',
            'Laboratorium Fisika',
            'Laboratorium Komputer',
            'Laboratorium Biologi',
            'Laboratorium Bahasa',
            'Ruang Tamu',
            'IT, Multimedia & Marketing',
            'Ruang UKS',
            'Ruang Yayasan',
            'Ruang Guru',
            'Ruang Kepsek',
            'Ruang Wakakur',
            'Ruang Wakasar',
            'Ruang Serbaguna SMA',
            'Ruang Kuliner',
            'Ruang Musik',
            'Perpustakaan',
            'Kantin',
            'Lapangan Badminton',
            'Lapangan Tenis Meja',
            'Kolam Renang',
            'Lapangan Basket',
            'Lapangan Voli',
            'Lapangan Tenis',
            'Lapangan Senam',
            'Lapangan Futsal',
        ];
        $data['tempatOptions'] = $tempatOptions;
        echo view('create', $data);
    }

    public function store()
    {
        $request = \Config\Services::request();
        $model = new Pengajuan();
        $data['pengajuan'] = $model->findAll();
        // echo view('pengajuan/index', $data);

        $data = [
            'penanggung_jawab' => user()->fullname,
            'user_id' => user()->id,
            'orang_terlibat' => $this->request->getPost('orang_terlibat'),
            'hari_tanggal' => $this->request->getPost('hari_tanggal'),
            'waktu_awal' => $this->request->getPost('waktu_awal'),
            'waktu_akhir' => $this->request->getPost('waktu_akhir'),
            'Tempat_yang_dipakai' => $this->request->getPost('Tempat_yang_dipakai'),
            'peralatan' => $this->request->getPost('peralatan'),
            'kegunaan' => $this->request->getPost('kegunaan'),
            'status' => $this->request->getPost('status') ?: 'Menunggu validasi', // set default value to "Menunggu validasi" if status is not provided
        ];
        // dd($data);
        // Check if the selected room is already booked
        $isRoomBooked = $model->where('Tempat_yang_dipakai', $data['Tempat_yang_dipakai'])
            ->where('hari_tanggal', $data['hari_tanggal'])
            ->where('waktu_awal <=', $data['waktu_akhir'])
            ->where('waktu_akhir >=', $data['waktu_awal'])
            ->first();

        if ($isRoomBooked) {
            // Room is already booked
            return redirect()->back()->withInput()->with('error', 'Ruangan sudah dipesan pada waktu tersebut. Silakan pilih waktu yang lain.');
        }

        $model->save($data);
        return redirect()->to('/pengajuan');
    }

    public function edit()
    {
        $model = new Pengajuan();
        $id = $this->request->uri->getSegment(3);
        $data['pengajuan'] = $model->find($id);
        echo view('pengajuan/edit', $data);
    }

    public function update()
    {
        $request = \Config\Services::request();
        $model = new Pengajuan();
        $id = $request->getVar('id');

        $data = [
            'penanggung_jawab' => $this->request->getPost('penanggung_jawab'),
            'orang_terlibat' => $this->request->getPost('orang_terlibat'),
            'hari_tanggal' => $this->request->getPost('hari_tanggal'),
            'waktu_awal' => $this->request->getPost('waktu_awal'),
            'waktu_akhir' => $this->request->getPost('waktu_akhir'),
            'Tempat_yang_dipakai' => $this->request->getPost('Tempat_yang_dipakai'),
            'peralatan' => $this->request->getPost('peralatan'),
            'kegunaan' => $this->request->getPost('kegunaan'),
            'status' => $this->request->getPost('status') ?$this->request->getPost('status'): 'Menunggu validasi', // set default value to "Menunggu validasi" if status is not provided
        ];

        $model->update($id, $data);

        $pengajuan = $model->find($id);
$users = $this->db->query("SELECT *
FROM users u WHERE u.id='" . $pengajuan['user_id'] . "'")->getRow();
// dd($users->email);

        if ($this->request->getPost('status') == 'Telah disetujui'){

     

		sendingEmail($users->email, 'Permintaan Pengajuan', 'Permintaan Pengajuan Anda Telah disetujui');
    
        }else{
		sendingEmail($users->email, 'Permintaan Pengajuan', 'Permintaan Pengajuan Anda Telah ditolak');

        }
        return redirect()->to('/pengajuan');
    }

    public function delete()
    {
        $model = new Pengajuan();
        $id = $this->request->uri->getSegment(3);
        $model->delete($id);
        return redirect()->to('/pengajuan');
    }
}
