<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id', function (Transaction $transaction) {
                    $transaction = Transaction::with('user')->find($transaction->id);
                    return $transaction->user->name;
                })
                ->editColumn('car_id', function (Transaction $transaction) {
                    $transaction = Transaction::with('car')->find($transaction->id);
                    return $transaction->car->name;
                })
                ->editColumn('date_start', function (Transaction $transaction) {
                    return Carbon::parse($transaction->date_start)->format('d F Y');
                })
                ->editColumn('date_end', function (Transaction $transaction) {
                    return Carbon::parse($transaction->date_end)->format('d F Y');
                })
                ->editColumn('total', function (Transaction $transaction) {
                    return number_format($transaction->total, 2);
                })
                ->addColumn('action', function (Transaction $transaction) {
                    $btn = '<a href=' . route("transaction.edit", $transaction->id) . ' class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i>edit</a>';
                    $btn = $btn . '<form class="d-inline" action=' . route("transaction.destroy", $transaction->id) . ' method="POST">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="_token" value=' . csrf_token() . '>
<button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i>delete</button>
</form>';
                    $btn = $btn . '<a href=' . route("transaction.show", $transaction->id) . ' class="btn btn-info btn-sm"><i class="fas fa-eye"></i>detail</a>';
                    $btn = $btn . '<form class="d-inline" action=' . route("transaction.status", $transaction->id) . ' method="POST">
<input type="hidden" name="_token" value=' . csrf_token() . '>
<input type="hidden" name="status" value="SUCCESS">
<button class="btn btn-outline-success btn-sm" type="submit"><i class="far fa-check-circle"></i>success</button>
</form>';
                    $btn = $btn . '<form class="d-inline" action=' . route("transaction.status", $transaction->id) . ' method="POST">
<input type="hidden" name="_token" value=' . csrf_token() . '>
<input type="hidden" name="status" value="FAILED">
<button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-times-circle"></i>failed</button>
</form>';
                    return $btn;
                })
                ->rawColumns(['action', 'modal'])
                ->make(true);
        }
        return view('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Create';
        $cars = Car::all();
        $users = User::all();
        return view('transaction.createOrUpdate', compact('cars', 'users', 'text'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'    =>  'required',
            'car_id'    =>  'required',
            'date_start'    =>  'required',
            'date_end'    =>  'required',
            'note'    =>  'required',
        ]);
        $data['date_due'] = $request->date_end;
        $data['status'] = 'PENDING';
        $price = Car::find($request->car_id);
        $date_start = new DateTime($request->date_start);
        $date_end = new DateTime($request->date_end);
        $duration = $date_start->diff($date_end);
        $data['total'] = $price->price * $duration->days;
        Transaction::create($data);
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction = Transaction::with('user', 'car')->find($transaction->id);
        return view('transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $text = 'Edit';
        $users = User::all();
        $cars = Car::all();
        return view('transaction.createOrUpdate', compact('users', 'cars', 'transaction', 'text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'user_id'    =>  'required',
            'car_id'    =>  'required',
            'date_start'    =>  'required',
            'date_end'    =>  'required',
            'note'    =>  'required',
        ]);
        $price = Car::find($request->car_id);
        $date_start = new DateTime($request->date_start);
        $date_end = new DateTime($request->date_end);
        $duration = $date_start->diff($date_end);
        $data['total'] = $price->price * $duration->days;
        $transaction->update($data);
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Transaction::destroy($transaction->id);
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dihapus');
    }
    public function status(Request $request, Transaction $transaction)
    {
        $transaction->update([
            'status'    =>  $request->status
        ]);
        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil diupdate');
    }
}