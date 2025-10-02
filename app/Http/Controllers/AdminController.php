<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_shipments' => Shipment::count(),
            'active_shipments' => Shipment::whereIn('status', ['in_transit', 'out_for_delivery'])->count(),
            'pending_shipments' => Shipment::where('status', 'pending')->count(),
            'delivered_shipments' => Shipment::where('status', 'delivered')->count(),
            'total_revenue' => $this->calculateTotalRevenue(),
            'monthly_revenue' => $this->calculateMonthlyRevenue(),
            'user_growth' => $this->calculateUserGrowth(),
            'recent_users' => User::where('role', 'user')
                ->latest()
                ->take(5)
                ->get(['id', 'name', 'email', 'created_at']),
        ];

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
        ]);
    }

    /**
     * Calculate user growth percentage
     */
    private function calculateUserGrowth()
    {
        $currentMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
            
        $lastMonth = User::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();
            
        if ($lastMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }
        
        return round((($currentMonth - $lastMonth) / $lastMonth) * 100);
    }

    /**
     * Calculate total revenue from shipments
     */
    private function calculateTotalRevenue()
    {
        $shipments = Shipment::whereNotNull('total_freight')->get();
        $total = 0;
        
        foreach ($shipments as $shipment) {
            // Extract numeric value from total_freight (remove currency symbols)
            $freight = preg_replace('/[^0-9.]/', '', $shipment->total_freight);
            if (is_numeric($freight)) {
                $total += (float) $freight;
            }
        }
        
        return $total;
    }

    /**
     * Calculate monthly revenue from shipments
     */
    private function calculateMonthlyRevenue()
    {
        $shipments = Shipment::whereNotNull('total_freight')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->get();
            
        $total = 0;
        
        foreach ($shipments as $shipment) {
            // Extract numeric value from total_freight (remove currency symbols)
            $freight = preg_replace('/[^0-9.]/', '', $shipment->total_freight);
            if (is_numeric($freight)) {
                $total += (float) $freight;
            }
        }
        
        return $total;
    }

    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Display a listing of users (alias for index)
     */
    public function users()
    {
        return $this->index();
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Show the form for creating a new user (alias for create)
     */
    public function createUser()
    {
        return $this->create();
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Store a newly created user (alias for store)
     */
    public function storeUser(Request $request)
    {
        return $this->store($request);
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        return Inertia::render('Admin/Users/Show', [
            'user' => $user,
        ]);
    }

    /**
     * Display the specified user (alias for show)
     */
    public function showUser(User $user)
    {
        return $this->show($user);
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified user (alias for edit)
     */
    public function editUser(User $user)
    {
        return $this->edit($user);
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Update the specified user (alias for update)
     */
    public function updateUser(Request $request, User $user)
    {
        return $this->update($request, $user);
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Remove the specified user (alias for destroy)
     */
    public function destroyUser(User $user)
    {
        return $this->destroy($user);
    }

}
