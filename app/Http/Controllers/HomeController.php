<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Repositories\LoanRepository;
use App\Services\LoanService;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

	public function index(LoanRepository $loanRepo, LoanService $loanService): View
	{
		$totalBook = Book::count();
		$totalMember = Member::count();
		$totalLoan = Loan::count();
		$activeLoan = $loanRepo->countActive();
		$loanPerMonth = $loanService->gerPerMonth();
		$topBook = $loanService->getTopBook();

		return view('home', compact('totalBook', 'totalMember', 'totalLoan', 'activeLoan', 'loanPerMonth', 'topBook'));
	}

}
