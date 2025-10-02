import { Head } from '@inertiajs/react'
import AppLayout from '@/layouts/app-layout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Users, UserCheck, Package, TrendingUp, DollarSign, Clock, CheckCircle, AlertCircle, Activity } from 'lucide-react'

interface Stats {
  total_users: number
  total_admins: number
  total_shipments: number
  active_shipments: number
  pending_shipments: number
  delivered_shipments: number
  total_revenue: number
  monthly_revenue: number
  user_growth: number
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
    <AppLayout>
      <Head title="Admin Dashboard" />
      
      <div className="space-y-6 p-6">
        {/* Header */}
        <div>
          <h1 className="text-3xl font-bold tracking-tight">Dashboard</h1>
          <p className="text-muted-foreground">Overview of your shipment management system</p>
        </div>

        {/* Key Metrics */}
        <div className="grid gap-3 md:grid-cols-2 lg:grid-cols-4">
          <Card className="p-4">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2 px-0 pt-0">
              <CardTitle className="text-sm font-medium">Total Users</CardTitle>
              <Users className="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="text-2xl font-bold">{stats.total_users}</div>
              <p className="text-xs text-muted-foreground">
                +{stats.user_growth}% from last month
              </p>
            </CardContent>
          </Card>

          <Card className="p-4">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2 px-0 pt-0">
              <CardTitle className="text-sm font-medium">Total Shipments</CardTitle>
              <Package className="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="text-2xl font-bold">{stats.total_shipments}</div>
              <p className="text-xs text-muted-foreground">
                All time shipments
              </p>
            </CardContent>
          </Card>

          <Card className="p-4">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2 px-0 pt-0">
              <CardTitle className="text-sm font-medium">Active Shipments</CardTitle>
              <Activity className="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="text-2xl font-bold">{stats.active_shipments}</div>
              <p className="text-xs text-muted-foreground">
                Currently in transit
              </p>
            </CardContent>
          </Card>

          <Card className="p-4">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2 px-0 pt-0">
              <CardTitle className="text-sm font-medium">Total Revenue</CardTitle>
              <DollarSign className="h-4 w-4 text-muted-foreground" />
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="text-2xl font-bold">${stats.total_revenue.toLocaleString()}</div>
              <p className="text-xs text-muted-foreground">
                +${stats.monthly_revenue.toLocaleString()} this month
              </p>
            </CardContent>
          </Card>
        </div>

        {/* Shipment Status Overview */}
        <div className="grid gap-3 md:grid-cols-3">
          <Card className="p-4">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2 px-0 pt-0">
              <CardTitle className="text-sm font-medium">Pending</CardTitle>
              <Clock className="h-4 w-4 text-yellow-600" />
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="text-2xl font-bold">{stats.pending_shipments}</div>
              <p className="text-xs text-muted-foreground">
                Awaiting pickup
              </p>
            </CardContent>
          </Card>

          <Card className="p-4">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2 px-0 pt-0">
              <CardTitle className="text-sm font-medium">In Transit</CardTitle>
              <TrendingUp className="h-4 w-4 text-blue-600" />
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="text-2xl font-bold">{stats.active_shipments}</div>
              <p className="text-xs text-muted-foreground">
                On the way
              </p>
            </CardContent>
          </Card>

          <Card className="p-4">
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2 px-0 pt-0">
              <CardTitle className="text-sm font-medium">Delivered</CardTitle>
              <CheckCircle className="h-4 w-4 text-green-600" />
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="text-2xl font-bold">{stats.delivered_shipments}</div>
              <p className="text-xs text-muted-foreground">
                Successfully delivered
              </p>
            </CardContent>
          </Card>
        </div>

        {/* Recent Activity */}
        <div className="grid gap-3 md:grid-cols-2">
          <Card className="p-4">
            <CardHeader className="px-0 pt-0">
              <CardTitle className="text-base">Recent Users</CardTitle>
              <CardDescription className="text-sm">
                Latest users who joined the platform
              </CardDescription>
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="space-y-3">
                {stats.recent_users.length > 0 ? (
                  stats.recent_users.map((user) => (
                    <div key={user.id} className="flex items-center space-x-3">
                      <div className="flex-1 space-y-1">
                        <p className="text-sm font-medium leading-none">
                          {user.name}
                        </p>
                        <p className="text-sm text-muted-foreground">
                          {user.email}
                        </p>
                      </div>
                      <div className="text-xs text-muted-foreground">
                        {new Date(user.created_at).toLocaleDateString()}
                      </div>
                    </div>
                  ))
                ) : (
                  <p className="text-sm text-muted-foreground">No recent users</p>
                )}
              </div>
            </CardContent>
          </Card>

          <Card className="p-4">
            <CardHeader className="px-0 pt-0">
              <CardTitle className="text-base">System Status</CardTitle>
              <CardDescription className="text-sm">
                Current system health and performance
              </CardDescription>
            </CardHeader>
            <CardContent className="px-0 pb-0">
              <div className="space-y-3">
                <div className="flex items-center justify-between">
                  <div className="flex items-center space-x-2">
                    <div className="h-2 w-2 bg-green-500 rounded-full"></div>
                    <span className="text-sm">Database</span>
                  </div>
                  <Badge variant="outline" className="text-green-600 text-xs">Online</Badge>
                </div>
                <div className="flex items-center justify-between">
                  <div className="flex items-center space-x-2">
                    <div className="h-2 w-2 bg-green-500 rounded-full"></div>
                    <span className="text-sm">Email Service</span>
                  </div>
                  <Badge variant="outline" className="text-green-600 text-xs">Active</Badge>
                </div>
                <div className="flex items-center justify-between">
                  <div className="flex items-center space-x-2">
                    <div className="h-2 w-2 bg-yellow-500 rounded-full"></div>
                    <span className="text-sm">API Rate Limit</span>
                  </div>
                  <Badge variant="outline" className="text-yellow-600 text-xs">75% Used</Badge>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  )
}

