<?php 

namespace App\Services;

use App\Repositories\LoanRepository;

use Yajra\Datatables\Datatables;

class LoanService {

	protected $repo;

	public function __construct(LoanRepository $repo)
	{
		$this->repo = $repo;
	}

	public function returnBook(int $id)
	{
		$loan = $this->repo->find($id);
		$loan->status = 1;
		$loan->book->status = 0;
		$loan->push();
		$loan->save();
	}

	public function extendBook(int $id, string $return)
	{
		$loan = $this->repo->find($id);
		$loan->return_date = $return;
		$loan->save();
	}

	public function gerPerMonth(): Array
	{
		$data = [];

		for ($i=1; $i <= 12; $i++) { 
			$loan = $this->repo->countByMonth($i);

			array_push($data, $loan);
		}

		return $data;
	}

	public function getTopBook(): Array
	{
		$total = [];
		$book = [];
		$topBook = $this->repo->getTopBook();

		foreach ($topBook as $loan) {
			array_push($total, $loan->total);
			array_push($book, $loan->book->title);
		}

		return [
			'total' => $total,
			'book' => $book
		];
	}

	public function getDatatables(): Object
	{
		$datatables = Datatables::of($this->repo->get())
					->addIndexColumn()
					->editColumn('create_date', function ($loan)
					{
						return $loan->createLocal;
					})
					->editColumn('return_date', function ($loan)
					{
						return $loan->returnLocal;
					})
					->editColumn('status', function ($loan)
					{
						return $loan->statusBadge;
					})
					->addColumn('action', function ($loan)
					{
						return '
							<button class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></button>
						';
					})
					->rawColumns(['status', 'action'])
					->make();

		return $datatables;
	}

}

 ?>