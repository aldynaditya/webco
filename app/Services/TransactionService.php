<?php 

namespace App\Services;

use App\Models\Pricing;
use App\Models\Transaction;
use App\Repositories\PricingRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    protected $transactionRepository;
    protected $pricingRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository, PricingRepositoryInterface $pricingRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->pricingRepository = $pricingRepository;
    }

    public function prepareCheckout(Pricing $pricing)
    {
        $user = Auth::user();
        $alreadySubscribed = $pricing->isSubscribedByUser($user->id);

        $tax = 0.12;
        $total_tax_amount = $pricing->price * $tax;
        $sub_total_amount = $pricing->price;
        $grand_total_amount = $sub_total_amount + $total_tax_amount;

        $started_at = now();
        $ended_at = $started_at->copy()->addMonths($pricing->duration);

        session()->put('pricing_id', $pricing->id);

        return compact(
            'total_tax_amount',
            'sub_total_amount',
            'grand_total_amount',
            'pricing',
            'started_at',
            'ended_at',
            'user',
            'alreadySubscribed'
        );
    }

    public function getRecentPricing()
    {
        $pricingId = session()->get('pricing_id');

        return $this->pricingRepository->findById($pricingId);
    }

    public function getUserTransactions()
    {
        $user = Auth::user();

        return $this->transactionRepository->getUserTransactions($user->id);
    }
}