<?php 

namespace App\Repositories;

use App\Models\Loan;

class LoanRepository extends Repository {

	public function __construct(Loan $loan)
	{
		$this->model = $loan;
	}

	public function get(): Object
	{
		return $this->model->with(['book:id,code,title', 'member:id,name'])->latest()->get();
	}

	public function getByCode(string $code)
	{
		return $this->model->whereStatus(0)->whereHas('book', function ($book) use($code)
		{
			return $book->whereCode($code);
		})->first();
	}

	public function countByMonth(int $month): Int
	{
		return $this->model->whereMonth('created_at', $month)->count();
	}

	public function getTopBook(): Object
	{
		return $this->model->selectRaw('book_id, COUNT(*) as total')->with('book:id,title')->groupBy('book_id')->latest('total')->take(5)->get();
	}

	public function countActive(): Int
	{
		return $this->model->whereStatus(0)->count();
	}

}

 ?>