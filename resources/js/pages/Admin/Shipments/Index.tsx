import { Head, Link } from '@inertiajs/react'
import AdminLayout from '@/layouts/AdminLayout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { Plus, Edit, Trash2, Eye, Package, MapPin, Clock } from 'lucide-react'

interface User {
  id: number
  name: string
  email: string
}

interface Shipment {
  id: number
  tracking_number: string
  status: string
  receiver_name: string
  receiver_phone: string
  receiver_email: string
  shipper_name: string
  shipper_phone: string
  shipper_email: string
  expected_delivery_date: string | null
  created_at: string
  user: User
}

interface ShipmentsIndexProps {
  shipments: {
    data: Shipment[]
    links: Array<{
      url: string | null
      label: string
      active: boolean
    }>
    meta: {
      current_page: number
      last_page: number
      per_page: number
      total: number
    }
  }
}

export default function ShipmentsIndex({ shipments }: ShipmentsIndexProps) {
  const getStatusBadgeVariant = (status: string) => {
    switch (status) {
      case 'pending':
        return 'secondary'
      case 'in_transit':
        return 'default'
      case 'delivered':
        return 'default'
      case 'cancelled':
        return 'destructive'
      default:
        return 'outline'
    }
  }

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'pending':
        return 'text-yellow-400'
      case 'in_transit':
        return 'text-blue-400'
      case 'delivered':
        return 'text-green-400'
      case 'cancelled':
        return 'text-red-400'
      default:
        return 'text-gray-400'
    }
  }

  return (
    <AdminLayout>
      <Head title="Shipments Management" />
      
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-2xl font-bold text-white">Shipments</h1>
            <p className="text-slate-300">Manage and track all shipments</p>
          </div>
          <Button asChild>
            <Link href="/admin/shipments/create">
              <Plus className="mr-2 h-4 w-4" />
              Create Shipment
            </Link>
          </Button>
        </div>

        {/* Shipments Table */}
        <Card className="bg-slate-700 border-slate-600">
          <CardHeader>
            <CardTitle className="text-white">All Shipments</CardTitle>
            <CardDescription className="text-slate-300">
              A list of all shipments in the system with their current status and tracking information.
            </CardDescription>
          </CardHeader>
          <CardContent>
            <Table>
              <TableHeader>
                <TableRow className="border-slate-600">
                  <TableHead className="text-slate-300">Tracking</TableHead>
                  <TableHead className="text-slate-300">Status</TableHead>
                  <TableHead className="text-slate-300">Receiver</TableHead>
                  <TableHead className="text-slate-300">Sender</TableHead>
                  <TableHead className="text-slate-300">Created</TableHead>
                  <TableHead className="text-right text-slate-300">Actions</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {shipments.data.map((shipment) => (
                  <TableRow key={shipment.id} className="border-slate-600 hover:bg-slate-600">
                    <TableCell>
                      <div className="flex items-center space-x-2">
                        <Package className="h-4 w-4 text-slate-400" />
                        <div>
                          <div className="font-medium text-white">{shipment.tracking_number}</div>
                          <div className="text-sm text-slate-400">
                            {new Date(shipment.created_at).toLocaleDateString()}
                          </div>
                        </div>
                      </div>
                    </TableCell>
                    <TableCell>
                      <Badge variant={getStatusBadgeVariant(shipment.status)} className={getStatusColor(shipment.status)}>
                        {shipment.status.replace('_', ' ').toUpperCase()}
                      </Badge>
                    </TableCell>
                    <TableCell>
                      <div>
                        <div className="font-medium text-white">{shipment.receiver_name}</div>
                        <div className="text-xs text-slate-400">{shipment.receiver_email}</div>
                        {shipment.expected_delivery_date && (
                          <div className="flex items-center space-x-1 text-sm text-slate-400 mt-1">
                            <Clock className="h-3 w-3" />
                            <span>ETA: {new Date(shipment.expected_delivery_date).toLocaleDateString()}</span>
                          </div>
                        )}
                      </div>
                    </TableCell>
                    <TableCell>
                      <div>
                        <div className="font-medium text-white">{shipment.shipper_name}</div>
                        <div className="text-xs text-slate-400">{shipment.shipper_email}</div>
                      </div>
                    </TableCell>
                    <TableCell className="text-slate-300">
                      {new Date(shipment.created_at).toLocaleDateString()}
                    </TableCell>
                    <TableCell className="text-right">
                      <div className="flex items-center justify-end space-x-2">
                        <Button variant="ghost" size="sm" asChild className="text-slate-300 hover:text-white hover:bg-slate-600">
                          <Link href={`/admin/shipments/${shipment.id}`}>
                            <Eye className="h-4 w-4" />
                          </Link>
                        </Button>
                        <Button variant="ghost" size="sm" asChild className="text-slate-300 hover:text-white hover:bg-slate-600">
                          <Link href={`/admin/shipments/${shipment.id}/edit`}>
                            <Edit className="h-4 w-4" />
                          </Link>
                        </Button>
                        <Button variant="ghost" size="sm" className="text-red-400 hover:text-red-300 hover:bg-slate-600">
                          <Trash2 className="h-4 w-4" />
                        </Button>
                      </div>
                    </TableCell>
                  </TableRow>
                ))}
              </TableBody>
            </Table>

            {/* Pagination */}
            {shipments.links.length > 3 && (
              <div className="flex items-center justify-between mt-4">
                <div className="text-sm text-slate-400">
                  Showing {shipments.meta.per_page * (shipments.meta.current_page - 1) + 1} to{' '}
                  {Math.min(shipments.meta.per_page * shipments.meta.current_page, shipments.meta.total)} of{' '}
                  {shipments.meta.total} results
                </div>
                <div className="flex space-x-2">
                  {shipments.links.map((link, index) => (
                    <Button
                      key={index}
                      variant={link.active ? 'default' : 'outline'}
                      size="sm"
                      asChild={!!link.url}
                      disabled={!link.url}
                      className={link.active ? 'bg-slate-600 text-white' : 'border-slate-500 text-slate-300 hover:bg-slate-600'}
                    >
                      {link.url ? (
                        <Link href={link.url}>
                          <span dangerouslySetInnerHTML={{ __html: link.label }} />
                        </Link>
                      ) : (
                        <span dangerouslySetInnerHTML={{ __html: link.label }} />
                      )}
                    </Button>
                  ))}
                </div>
              </div>
            )}
          </CardContent>
        </Card>
      </div>
    </AdminLayout>
  )
}
