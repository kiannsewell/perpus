<?php

namespace App\Http\Livewire\Loan;

use App\Repositories\LoanRepository;
use App\Services\LoanService;

use Livewire\Component;

class ExtendForm extends Component
{

	public $loan;
	public $late;
	public $fine;
	public $extend;

	protected $listeners = ['extendBook' => 'setLoan'];

	public function setLoan(LoanRepository $repo, string $code)
	{
		$loan = $repo->getByCode($code);

		if ($loan) {
			$this->loan = $loan;
			$this->late = $loan->late;
			$this->fine = $loan->fine;
		} else {
			$this->emit('notFound');
		}

	}

	public function extendBook(LoanService $loan)
	{
		$this->validate([
			'extend' => 'required|date|after:today'
		]);

		$loan->extendBook($this->loan->id, $this->extend);

		session()->flash('success', 'Sukses Perpanjang Buku');
		return redirect('/loan');
	}

    public function render()
    {
        return view('livewire.loan.extend-form');
    }
}
