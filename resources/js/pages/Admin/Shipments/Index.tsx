import { Head, Link } from '@inertiajs/react'
import AppLayout from '@/layouts/app-layout'
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
  const getStatusBadgeVariant = (status: string): "outline" => {
    // Use outline variant for all statuses since we're using custom colors
    return 'outline'
  }

  const getStatusColor = (status: string) => {
    switch (status) {
      case 'pending':
        return 'bg-amber-100 text-amber-800 border-amber-200'
      case 'confirmed':
        return 'bg-blue-100 text-blue-800 border-blue-200'
      case 'processing':
        return 'bg-violet-100 text-violet-800 border-violet-200'
      case 'picked_up':
        return 'bg-indigo-100 text-indigo-800 border-indigo-200'
      case 'in_transit':
        return 'bg-sky-100 text-sky-800 border-sky-200'
      case 'out_for_delivery':
        return 'bg-cyan-100 text-cyan-800 border-cyan-200'
      case 'delivery_attempted':
        return 'bg-orange-100 text-orange-800 border-orange-200'
      case 'delivered':
        return 'bg-emerald-100 text-emerald-800 border-emerald-200'
      case 'returned':
        return 'bg-rose-100 text-rose-800 border-rose-200'
      case 'cancelled':
        return 'bg-red-100 text-red-800 border-red-200'
      case 'on_hold':
        return 'bg-yellow-100 text-yellow-800 border-yellow-200'
      case 'exception':
        return 'bg-red-100 text-red-800 border-red-200'
      default:
        return 'bg-gray-100 text-gray-800 border-gray-200'
    }
  }

  return (
    <AppLayout>
      <Head title="Shipments Management" />
      
      <div className="p-6 space-y-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-3xl font-bold tracking-tight">Shipments</h1>
            <p className="text-muted-foreground">Manage and track all shipments</p>
          </div>
          <Button asChild>
            <Link href="/admin/shipments/create">
              <Plus className="mr-2 h-4 w-4" />
              Create Shipment
            </Link>
          </Button>
        </div>

        {/* Shipments Table */}
        <Card className="p-4">
          <CardHeader className="px-0 pt-0">
            <CardTitle className="text-base">All Shipments</CardTitle>
            <CardDescription className="text-sm">
              A list of all shipments in the system with their current status and tracking information.
            </CardDescription>
          </CardHeader>
          <CardContent className="px-0">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>Tracking</TableHead>
                  <TableHead>Status</TableHead>
                  <TableHead>Receiver</TableHead>
                  <TableHead>Sender</TableHead>
                  <TableHead>Created</TableHead>
                  <TableHead className="text-right">Actions</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {shipments.data.map((shipment) => (
                  <TableRow key={shipment.id}>
                    <TableCell>
                      <div className="flex items-center space-x-2">
                        <Package className="h-4 w-4 text-muted-foreground" />
                        <div>
                          <div className="font-medium">{shipment.tracking_number}</div>
                          <div className="text-sm text-muted-foreground">
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
                        <div className="font-medium">{shipment.receiver_name}</div>
                        <div className="text-xs text-muted-foreground">{shipment.receiver_email}</div>
                        {shipment.expected_delivery_date && (
                          <div className="flex items-center space-x-1 text-sm text-muted-foreground mt-1">
                            <Clock className="h-3 w-3" />
                            <span>ETA: {new Date(shipment.expected_delivery_date).toLocaleDateString()}</span>
                          </div>
                        )}
                      </div>
                    </TableCell>
                    <TableCell>
                      <div>
                        <div className="font-medium">{shipment.shipper_name}</div>
                        <div className="text-xs text-muted-foreground">{shipment.shipper_email}</div>
                      </div>
                    </TableCell>
                    <TableCell className="text-muted-foreground">
                      {new Date(shipment.created_at).toLocaleDateString()}
                    </TableCell>
                    <TableCell className="text-right">
                      <div className="flex items-center justify-end space-x-2">
                        <Button variant="ghost" size="sm" asChild>
                          <Link href={`/admin/shipments/${shipment.id}`}>
                            <Eye className="h-4 w-4" />
                          </Link>
                        </Button>
                        <Button variant="ghost" size="sm" asChild>
                          <Link href={`/admin/shipments/${shipment.id}/edit`}>
                            <Edit className="h-4 w-4" />
                          </Link>
                        </Button>
                        <Button variant="ghost" size="sm" className="text-red-500 hover:text-red-600">
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
                <div className="text-sm text-muted-foreground">
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
                      className={link.active ? '' : ''}
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
    </AppLayout>
  )
}
