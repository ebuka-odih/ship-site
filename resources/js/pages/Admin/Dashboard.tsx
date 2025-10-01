import { Head } from '@inertiajs/react'
import AdminLayout from '@/layouts/AdminLayout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Users, UserCheck, Package, TrendingUp } from 'lucide-react'

interface Stats {
  total_users: number
  total_admins: number
  recent_users: Array<{
    id: number
    name: string
    email: string
    created_at: string
  }>
}

interface DashboardProps {
  stats: Stats
}

export default function Dashboard({ stats }: DashboardProps) {
  return (
    <AdminLayout>
      <Head title="Admin Dashboard" />
      
      <div className="space-y-6">
        {/* Header */}
        <div>
          <h1 className="text-2xl font-bold text-white">Dashboard</h1>
          <p className="text-slate-300">Welcome to the shipment management system</p>
        </div>

        {/* Stats Cards */}
        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
          <Card className="bg-slate-700 border-slate-600">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium text-white">Total Users</CardTitle>
              <Users className="h-4 w-4 text-slate-400" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-white">{stats.total_users}</div>
              <p className="text-xs text-slate-400">
                Regular users in the system
              </p>
            </CardContent>
          </Card>

          <Card className="bg-slate-700 border-slate-600">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium text-white">Admin Users</CardTitle>
              <UserCheck className="h-4 w-4 text-slate-400" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-white">{stats.total_admins}</div>
              <p className="text-xs text-slate-400">
                Administrators with access
              </p>
            </CardContent>
          </Card>

          <Card className="bg-slate-700 border-slate-600">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium text-white">Total Shipments</CardTitle>
              <Package className="h-4 w-4 text-slate-400" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-white">0</div>
              <p className="text-xs text-slate-400">
                Shipments created
              </p>
            </CardContent>
          </Card>

          <Card className="bg-slate-700 border-slate-600">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <CardTitle className="text-sm font-medium text-white">Active Shipments</CardTitle>
              <TrendingUp className="h-4 w-4 text-slate-400" />
            </CardHeader>
            <CardContent>
              <div className="text-2xl font-bold text-white">0</div>
              <p className="text-xs text-slate-400">
                Currently in transit
              </p>
            </CardContent>
          </Card>
        </div>

        {/* Recent Users */}
        <div className="grid gap-4 md:grid-cols-2">
          <Card className="bg-slate-600 border-slate-500">
            <CardHeader>
              <CardTitle className="text-white">Recent Users</CardTitle>
              <CardDescription className="text-slate-300">
                Latest users who joined the platform
              </CardDescription>
            </CardHeader>
            <CardContent>
              <div className="space-y-4">
                {stats.recent_users.length > 0 ? (
                  stats.recent_users.map((user) => (
                    <div key={user.id} className="flex items-center space-x-4">
                      <div className="flex-1 space-y-1">
                        <p className="text-sm font-medium leading-none text-white">
                          {user.name}
                        </p>
                        <p className="text-sm text-slate-400">
                          {user.email}
                        </p>
                      </div>
                      <div className="text-xs text-slate-400">
                        {new Date(user.created_at).toLocaleDateString()}
                      </div>
                    </div>
                  ))
                ) : (
                  <p className="text-sm text-slate-400">No recent users</p>
                )}
              </div>
            </CardContent>
          </Card>

          <Card className="bg-slate-600 border-slate-500">
            <CardHeader>
              <CardTitle className="text-white">Quick Actions</CardTitle>
              <CardDescription className="text-slate-300">
                Common administrative tasks
              </CardDescription>
            </CardHeader>
            <CardContent>
              <div className="space-y-2">
                <div className="flex items-center justify-between">
                  <span className="text-sm text-white">Create new user</span>
                  <Badge variant="outline" className="border-slate-400 text-slate-300">Coming soon</Badge>
                </div>
                <div className="flex items-center justify-between">
                  <span className="text-sm text-white">View all shipments</span>
                  <Badge variant="outline" className="border-slate-400 text-slate-300">Coming soon</Badge>
                </div>
                <div className="flex items-center justify-between">
                  <span className="text-sm text-white">System settings</span>
                  <Badge variant="outline" className="border-slate-400 text-slate-300">Coming soon</Badge>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </AdminLayout>
  )
}

