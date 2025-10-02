import React from 'react'
import { Head, useForm, router } from '@inertiajs/react'
import AppLayout from '@/layouts/app-layout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog'
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table'
import { ArrowLeft, Edit, Package, MapPin, User, Phone, Mail, Weight, DollarSign, Clock, Truck, CheckCircle, XCircle, Plus, Trash2, Check, Loader2, ArrowUp, ArrowDown, AlertTriangle, Pause, AlertCircle, Download, FileText, Receipt } from 'lucide-react'
import { Link } from '@inertiajs/react'

interface User {
  id: number
  name: string
  email: string
}

interface TrackingEvent {
  status: string
  description: string
  location?: string
  timestamp: string
}

interface ShipmentHistory {
  id: number
  shipment_id: number
  status: string
  location: string | null
  note: string | null
  updated_by: string | null
  remarks: string | null
  created_at: string
  updated_at: string
}

interface Shipment {
  id: number
  tracking_number: string
  status: string
  
  // Shipper Information
  shipper_name: string
  shipper_phone: string
  shipper_address: string
  shipper_email: string
  
  // Receiver Information
  receiver_name: string
  receiver_phone: string
  receiver_address: string
  receiver_email: string
  
  // Shipment Details
  agent_name: string | null
  type_of_shipment: string | null
  weight: string | null
  courier: string | null
  packages: string | null
  mode: string | null
  product: string | null
  quantity: string | null
  
  // Payment & Freight
  payment_mode: string | null
  total_freight: string | null
  
  // Carrier Information
  carrier: string | null
  carrier_reference_no: string | null
  
  // Timing Information
  departure_time: string | null
  origin: string | null
  destination: string | null
  pickup_date: string | null
  pickup_time: string | null
  expected_delivery_date: string | null
  
  // Additional Information
  comments: string | null
  tracking_events: TrackingEvent[] | null
  histories: ShipmentHistory[]
  created_at: string
  user: User
}

interface ShowShipmentProps {
  shipment: Shipment
}

// Reusable Add History Modal Component
function AddHistoryModal({
  isOpen,
  onOpenChange,
  data,
  setData,
  onSubmit,
  processing,
  errors
}: {
  isOpen: boolean
  onOpenChange: (open: boolean) => void
  data: { status: string; location: string; note: string; updated_by: string; created_date: string; created_time: string }
  setData: (key: string, value: string) => void
  onSubmit: (e: React.FormEvent) => void
  processing: boolean
  errors: any
}) {
  return (
    <Dialog open={isOpen} onOpenChange={onOpenChange}>
      <DialogTrigger asChild>
        <Button className="bg-blue-600 hover:bg-blue-700 text-white w-full sm:w-auto">
          <Plus className="h-4 w-4 mr-2" />
          <span className="hidden sm:inline">Add Status Update</span>
          <span className="sm:hidden">Add Status</span>
        </Button>
      </DialogTrigger>
      <DialogContent className="bg-slate-800 border-slate-600 text-white max-w-2xl">
        <DialogHeader>
          <DialogTitle className="text-white flex items-center space-x-2">
            <Plus className="h-5 w-5" />
            <span>Add New Status Update</span>
          </DialogTitle>
          <DialogDescription className="text-muted-foreground">
            Add a new status update to track the shipment's progress
          </DialogDescription>
        </DialogHeader>
        <form onSubmit={onSubmit} className="space-y-4">
          {/* Status and Location Row */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <Label htmlFor="status" className="text-sm font-medium text-white">Status</Label>
              <Select value={data.status} onValueChange={(value) => setData('status', value)}>
                <SelectTrigger className="bg-slate-600 border-slate-500 text-white">
                  <SelectValue placeholder="Select status" />
                </SelectTrigger>
                <SelectContent className="bg-slate-700 border-slate-600">
                  <SelectItem value="pending" className="">Pending</SelectItem>
                  <SelectItem value="confirmed" className="">Confirmed</SelectItem>
                  <SelectItem value="processing" className="">Processing</SelectItem>
                  <SelectItem value="picked_up" className="">Picked Up</SelectItem>
                  <SelectItem value="in_transit" className="">In Transit</SelectItem>
                  <SelectItem value="out_for_delivery" className="">Out for Delivery</SelectItem>
                  <SelectItem value="delivery_attempted" className="">Delivery Attempted</SelectItem>
                  <SelectItem value="delivered" className="">Delivered</SelectItem>
                  <SelectItem value="returned" className="">Returned</SelectItem>
                  <SelectItem value="cancelled" className="">Cancelled</SelectItem>
                  <SelectItem value="on_hold" className="">On Hold</SelectItem>
                  <SelectItem value="exception" className="">Exception</SelectItem>
                </SelectContent>
              </Select>
              {errors.status && <p className="text-red-500 text-sm mt-1">{errors.status}</p>}
            </div>
            <div>
              <Label htmlFor="location" className="text-sm font-medium text-white">Location</Label>
              <Input
                id="location"
                type="text"
                value={data.location}
                onChange={(e) => setData('location', e.target.value)}
                className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                placeholder="Enter location (optional)"
              />
              {errors.location && <p className="text-red-500 text-sm mt-1">{errors.location}</p>}
            </div>
          </div>

          {/* Date and Time Row */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <Label htmlFor="created_date" className="text-sm font-medium text-white">Date</Label>
              <Input
                id="created_date"
                type="date"
                value={data.created_date}
                onChange={(e) => setData('created_date', e.target.value)}
                className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
              />
              {errors.created_date && <p className="text-red-500 text-sm mt-1">{errors.created_date}</p>}
            </div>
            <div>
              <Label htmlFor="created_time" className="text-sm font-medium text-white">Time</Label>
              <Input
                id="created_time"
                type="time"
                value={data.created_time}
                onChange={(e) => setData('created_time', e.target.value)}
                className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
              />
              {errors.created_time && <p className="text-red-500 text-sm mt-1">{errors.created_time}</p>}
            </div>
          </div>

          {/* Updated By Row */}
          <div>
            <Label htmlFor="updated_by" className="text-sm font-medium text-white">Updated By</Label>
            <Input
              id="updated_by"
              type="text"
              value={data.updated_by}
              onChange={(e) => setData('updated_by', e.target.value)}
              className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
              placeholder="Enter who updated this (optional)"
            />
            {errors.updated_by && <p className="text-red-500 text-sm mt-1">{errors.updated_by}</p>}
          </div>

          {/* Note Field */}
          <div>
            <Label htmlFor="note" className="text-sm font-medium text-white">Note</Label>
            <Textarea
              id="note"
              value={data.note}
              onChange={(e) => setData('note', e.target.value)}
              className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
              placeholder="Enter additional notes (optional)"
              rows={3}
            />
            {errors.note && <p className="text-red-500 text-sm mt-1">{errors.note}</p>}
          </div>
          <div className="flex justify-end space-x-2">
            <Button 
              type="button" 
              variant="outline" 
              onClick={() => onOpenChange(false)}
              className=""
            >
              Cancel
            </Button>
            <Button 
              type="submit" 
              disabled={processing}
              className="bg-blue-600 hover:bg-blue-700 text-white"
            >
              {processing ? 'Adding...' : 'Add Status Update'}
            </Button>
          </div>
        </form>
      </DialogContent>
    </Dialog>
  )
}

export default function ShowShipment({ shipment }: ShowShipmentProps) {
  const { data, setData, post, processing, errors, reset } = useForm({
    status: '',
    location: '',
    note: '',
    updated_by: '',
    created_date: '',
    created_time: '',
  })

  const [showSuccess, setShowSuccess] = React.useState(false)
  const [isModalOpen, setIsModalOpen] = React.useState(false)

  const handleAddHistory = (e: React.FormEvent) => {
    e.preventDefault()
    post(`/admin/shipments/${shipment.id}/history`, {
      onSuccess: () => {
        // Clear the form fields and close modal
        setData('status', '')
        setData('location', '')
        setData('note', '')
        setData('updated_by', '')
        setData('created_date', '')
        setData('created_time', '')
        setIsModalOpen(false)
        // Show success message
        setShowSuccess(true)
        setTimeout(() => setShowSuccess(false), 3000)
      },
    })
  }

  const handleDeleteHistory = (historyId: number) => {
    if (confirm('Are you sure you want to delete this history entry?')) {
      router.delete(`/admin/shipments/${shipment.id}/history/${historyId}`)
    }
  }

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

  const getStatusIconColor = (status: string) => {
    switch (status) {
      case 'pending':
        return 'text-amber-600'
      case 'confirmed':
        return 'text-blue-600'
      case 'processing':
        return 'text-violet-600'
      case 'picked_up':
        return 'text-indigo-600'
      case 'in_transit':
        return 'text-sky-600'
      case 'out_for_delivery':
        return 'text-cyan-600'
      case 'delivery_attempted':
        return 'text-orange-600'
      case 'delivered':
        return 'text-emerald-600'
      case 'returned':
        return 'text-rose-600'
      case 'cancelled':
        return 'text-red-600'
      case 'on_hold':
        return 'text-yellow-600'
      case 'exception':
        return 'text-red-600'
      default:
        return 'text-gray-600'
    }
  }

  const getStatusIcon = (status: string) => {
    switch (status) {
      case 'pending':
        return Clock
      case 'confirmed':
        return Check
      case 'processing':
        return Loader2
      case 'picked_up':
        return ArrowUp
      case 'in_transit':
        return Truck
      case 'out_for_delivery':
        return Truck
      case 'delivery_attempted':
        return AlertTriangle
      case 'delivered':
        return CheckCircle
      case 'returned':
        return ArrowDown
      case 'cancelled':
        return XCircle
      case 'on_hold':
        return Pause
      case 'exception':
        return AlertCircle
      default:
        return Package
    }
  }

  return (
    <AppLayout>
      <Head title={`Shipment Details - ${shipment.tracking_number}`} />
      
      <div className="p-6 space-y-6">
        {/* Header */}
        <div className="space-y-4">
          {/* Top row - Back button and title */}
          <div className="flex items-center space-x-4">
            <Button variant="ghost" size="sm" asChild>
              <Link href="/admin/shipments">
                <ArrowLeft className="h-4 w-4" />
              </Link>
            </Button>
            <div className="flex-1 min-w-0">
              <h1 className="text-3xl font-bold tracking-tight truncate">Shipment Details</h1>
              <p className="text-muted-foreground truncate">Tracking number: {shipment.tracking_number}</p>
            </div>
          </div>
          
          {/* Bottom row - Action buttons */}
          <div className="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <div className="flex-1 sm:flex-none">
              <AddHistoryModal
                isOpen={isModalOpen}
                onOpenChange={setIsModalOpen}
                data={data}
                setData={setData}
                onSubmit={handleAddHistory}
                processing={processing}
                errors={errors}
              />
            </div>
            <div className="flex-1 sm:flex-none">
              <Button asChild className="w-full sm:w-auto">
                <Link href={`/admin/shipments/${shipment.id}/edit`}>
                  <Edit className="mr-2 h-4 w-4" />
                  <span className="hidden sm:inline">Edit Shipment</span>
                  <span className="sm:hidden">Edit</span>
                </Link>
              </Button>
            </div>
            
            {/* PDF Download Buttons */}
            <div className="flex flex-col sm:flex-row gap-2">
              <Button 
                variant="outline" 
                size="sm" 
                className=""
                onClick={() => window.open(`/admin/shipments/${shipment.id}/pdf`, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes')}
              >
                <FileText className="h-4 w-4 mr-2" />
                <span className="hidden sm:inline">Details PDF</span>
                <span className="sm:hidden">PDF</span>
              </Button>
              <Button 
                variant="outline" 
                size="sm" 
                className=""
                onClick={() => window.open(`/admin/shipments/${shipment.id}/label`, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes')}
              >
                <Download className="h-4 w-4 mr-2" />
                <span className="hidden sm:inline">Label</span>
                <span className="sm:hidden">Label</span>
              </Button>
              <Button 
                variant="outline" 
                size="sm" 
                className=""
                onClick={() => window.open(`/admin/shipments/${shipment.id}/invoice`, '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes')}
              >
                <Receipt className="h-4 w-4 mr-2" />
                <span className="hidden sm:inline">Invoice</span>
                <span className="sm:hidden">Invoice</span>
              </Button>
            </div>
          </div>
        </div>

        <div className="grid gap-6 lg:grid-cols-3">
          {/* Main Content */}
          <div className="lg:col-span-2 space-y-6">
            {/* Status and Overview */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Package className="h-5 w-5 text-blue-500" />
                  <span>Shipment Overview</span>
                </CardTitle>
                <CardDescription className="text-muted-foreground">
                  Current status and basic information
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="flex items-center justify-between">
                  <div className="flex items-center space-x-3">
                    <div className="flex items-center space-x-2">
                      {(() => {
                        const StatusIcon = getStatusIcon(shipment.status)
                        return <StatusIcon className={`h-5 w-5 ${getStatusIconColor(shipment.status)}`} />
                      })()}
                      <span className="font-medium">Status</span>
                    </div>
                    <Badge variant={getStatusBadgeVariant(shipment.status)} className={getStatusColor(shipment.status)}>
                      {shipment.status.replace('_', ' ').toUpperCase()}
                    </Badge>
                  </div>
                  <div className="text-sm text-muted-foreground">
                    Created {new Date(shipment.created_at).toLocaleDateString()}
                  </div>
                </div>

                {shipment.comments && (
                  <div>
                    <h4 className="text-sm font-medium mb-2">Comments</h4>
                    <p className="text-muted-foreground">{shipment.comments}</p>
                  </div>
                )}
              </CardContent>
            </Card>

            {/* Shipper Information */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Package className="h-5 w-5 text-green-500" />
                  <span>Shipper Information</span>
                </CardTitle>
                <CardDescription className="text-muted-foreground">
                  Details about the person/company sending the shipment
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <div className="text-sm font-medium mb-1">Name</div>
                    <div className="text-muted-foreground">{shipment.shipper_name}</div>
                  </div>
                  <div>
                    <div className="text-sm font-medium mb-1">Phone</div>
                    <div className="text-muted-foreground">{shipment.shipper_phone}</div>
                  </div>
                  <div className="md:col-span-2">
                    <div className="text-sm font-medium mb-1">Email</div>
                    <div className="text-muted-foreground">{shipment.shipper_email}</div>
                  </div>
                  <div className="md:col-span-2">
                    <div className="text-sm font-medium mb-1">Address</div>
                    <div className="text-muted-foreground">{shipment.shipper_address}</div>
                  </div>
                </div>
              </CardContent>
            </Card>

            {/* Receiver Information */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <User className="h-5 w-5 text-blue-500" />
                  <span>Receiver Information</span>
                </CardTitle>
                <CardDescription className="text-muted-foreground">
                  Details about the person/company receiving the shipment
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <div className="text-sm font-medium mb-1">Name</div>
                    <div className="text-muted-foreground">{shipment.receiver_name}</div>
                  </div>
                  <div>
                    <div className="text-sm font-medium mb-1">Phone</div>
                    <div className="text-muted-foreground">{shipment.receiver_phone}</div>
                  </div>
                  <div className="md:col-span-2">
                    <div className="text-sm font-medium mb-1">Email</div>
                    <div className="text-muted-foreground">{shipment.receiver_email}</div>
                  </div>
                  <div className="md:col-span-2">
                    <div className="text-sm font-medium mb-1">Address</div>
                    <div className="text-muted-foreground">{shipment.receiver_address}</div>
                  </div>
                </div>
              </CardContent>
            </Card>

            {/* Shipment Details */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Package className="h-5 w-5 text-purple-500" />
                  <span>Shipment Details</span>
                </CardTitle>
                <CardDescription className="text-muted-foreground">
                  Information about the shipment and package
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {shipment.agent_name && (
                    <div>
                      <div className="text-sm font-medium mb-1">Agent Name</div>
                      <div className="text-muted-foreground">{shipment.agent_name}</div>
                    </div>
                  )}
                  {shipment.type_of_shipment && (
                    <div>
                      <div className="text-sm font-medium mb-1">Type of Shipment</div>
                      <div className="text-muted-foreground">{shipment.type_of_shipment}</div>
                    </div>
                  )}
                  {shipment.weight && (
                    <div>
                      <div className="text-sm font-medium mb-1">Weight</div>
                      <div className="text-muted-foreground">{shipment.weight}</div>
                    </div>
                  )}
                  {shipment.courier && (
                    <div>
                      <div className="text-sm font-medium mb-1">Courier</div>
                      <div className="text-muted-foreground">{shipment.courier}</div>
                    </div>
                  )}
                  {shipment.packages && (
                    <div>
                      <div className="text-sm font-medium mb-1">Packages</div>
                      <div className="text-muted-foreground">{shipment.packages}</div>
                    </div>
                  )}
                  {shipment.mode && (
                    <div>
                      <div className="text-sm font-medium mb-1">Mode</div>
                      <div className="text-muted-foreground">{shipment.mode}</div>
                    </div>
                  )}
                  {shipment.product && (
                    <div>
                      <div className="text-sm font-medium mb-1">Product</div>
                      <div className="text-muted-foreground">{shipment.product}</div>
                    </div>
                  )}
                  {shipment.quantity && (
                    <div>
                      <div className="text-sm font-medium mb-1">Quantity</div>
                      <div className="text-muted-foreground">{shipment.quantity}</div>
                    </div>
                  )}
                </div>
              </CardContent>
            </Card>

            {/* Payment & Freight */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <DollarSign className="h-5 w-5 text-yellow-500" />
                  <span>Payment & Freight</span>
                </CardTitle>
                <CardDescription className="text-muted-foreground">
                  Payment and freight information
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {shipment.payment_mode && (
                    <div>
                      <div className="text-sm font-medium mb-1">Payment Mode</div>
                      <div className="text-muted-foreground">{shipment.payment_mode}</div>
                    </div>
                  )}
                  {shipment.total_freight && (
                    <div>
                      <div className="text-sm font-medium mb-1">Total Freight</div>
                      <div className="text-muted-foreground">{shipment.total_freight}</div>
                    </div>
                  )}
                </div>
              </CardContent>
            </Card>

            {/* Carrier Information */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Package className="h-5 w-5 text-orange-500" />
                  <span>Carrier Information</span>
                </CardTitle>
                <CardDescription className="text-muted-foreground">
                  Carrier and reference details
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {shipment.carrier && (
                    <div>
                      <div className="text-sm font-medium mb-1">Carrier</div>
                      <div className="text-muted-foreground">{shipment.carrier}</div>
                    </div>
                  )}
                  {shipment.carrier_reference_no && (
                    <div>
                      <div className="text-sm font-medium mb-1">Carrier Reference No.</div>
                      <div className="text-muted-foreground">{shipment.carrier_reference_no}</div>
                    </div>
                  )}
                </div>
              </CardContent>
            </Card>

            {/* Timing Information */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <MapPin className="h-5 w-5 text-red-500" />
                  <span>Timing Information</span>
                </CardTitle>
                <CardDescription className="text-muted-foreground">
                  Dates, times, and locations
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {shipment.origin && (
                    <div>
                      <div className="text-sm font-medium mb-1">Origin</div>
                      <div className="text-muted-foreground">{shipment.origin}</div>
                    </div>
                  )}
                  {shipment.destination && (
                    <div>
                      <div className="text-sm font-medium mb-1">Destination</div>
                      <div className="text-muted-foreground">{shipment.destination}</div>
                    </div>
                  )}
                  {shipment.pickup_date && (
                    <div>
                      <div className="text-sm font-medium mb-1">Pickup Date</div>
                      <div className="text-muted-foreground">{new Date(shipment.pickup_date).toLocaleDateString()}</div>
                    </div>
                  )}
                  {shipment.pickup_time && (
                    <div>
                      <div className="text-sm font-medium mb-1">Pickup Time</div>
                      <div className="text-muted-foreground">{shipment.pickup_time}</div>
                    </div>
                  )}
                  {shipment.departure_time && (
                    <div>
                      <div className="text-sm font-medium mb-1">Departure Time</div>
                      <div className="text-muted-foreground">{shipment.departure_time}</div>
                    </div>
                  )}
                  {shipment.expected_delivery_date && (
                    <div>
                      <div className="text-sm font-medium mb-1">Expected Delivery Date</div>
                      <div className="text-muted-foreground">{new Date(shipment.expected_delivery_date).toLocaleDateString()}</div>
                    </div>
                  )}
                </div>
              </CardContent>
            </Card>

          </div>

          {/* Sidebar */}
          <div className="space-y-6">
            {/* Customer Information */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <User className="h-5 w-5 text-indigo-500" />
                  <span>Customer</span>
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div className="flex items-center space-x-3">
                  <Avatar className="h-10 w-10">
                    <AvatarImage src="" alt={shipment.user.name} />
                    <AvatarFallback>
                      {shipment.user.name.split(' ').map(n => n[0]).join('')}
                    </AvatarFallback>
                  </Avatar>
                  <div>
                    <div className="font-medium text-white">{shipment.user.name}</div>
                    <div className="text-sm text-slate-400">{shipment.user.email}</div>
                  </div>
                </div>
              </CardContent>
            </Card>

            {/* Quick Stats */}
            <Card className="p-4">
              <CardHeader className="px-0 pt-0 pb-4">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Package className="h-5 w-5 text-cyan-500" />
                  <span>Quick Info</span>
                </CardTitle>
              </CardHeader>
              <CardContent className="space-y-3">
                <div className="flex items-center justify-between">
                  <span className="text-sm text-slate-300">Tracking Number</span>
                  <span className="text-sm text-white font-mono">{shipment.tracking_number}</span>
                </div>
                <div className="flex items-center justify-between">
                  <span className="text-sm text-slate-300">Status</span>
                  <Badge variant={getStatusBadgeVariant(shipment.status)} className={getStatusColor(shipment.status)}>
                    {shipment.status.replace('_', ' ').toUpperCase()}
                  </Badge>
                </div>
                <div className="flex items-center justify-between">
                  <span className="text-sm text-slate-300">Created</span>
                  <span className="text-sm text-white">{new Date(shipment.created_at).toLocaleDateString()}</span>
                </div>
                {shipment.expected_delivery_date && (
                  <div className="flex items-center justify-between">
                    <span className="text-sm text-slate-300">Expected Delivery</span>
                    <span className="text-sm text-white">{new Date(shipment.expected_delivery_date).toLocaleDateString()}</span>
                  </div>
                )}
              </CardContent>
            </Card>
          </div>
        </div>

        {/* Shipment History Management - Full Width */}
        <div className="mt-6">
          <Card className="p-4">
            <CardHeader className="px-0 pt-0 pb-4">
              <CardTitle className="text-base flex items-center space-x-2">
                <Clock className="h-5 w-5 text-cyan-500" />
                <span>Shipment History</span>
              </CardTitle>
              <CardDescription className="text-muted-foreground">
                Manage shipment status updates and tracking events
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-6">
              {/* Success Message */}
              {showSuccess && (
                <div className="mb-4 p-3 bg-green-600 border border-green-500 rounded-lg">
                  <div className="flex items-center space-x-2">
                    <CheckCircle className="h-4 w-4 text-white" />
                    <span className="text-white text-sm font-medium">Status update added successfully!</span>
                  </div>
                </div>
              )}


              {/* History Table */}
              <div>
                <h4 className="text-white font-medium mb-4">Shipment History</h4>
                {shipment.histories && shipment.histories.length > 0 ? (
                  <div className="overflow-x-auto">
                    <Table>
                      <TableHeader>
                        <TableRow className="border-slate-600 bg-slate-700">
                          <TableHead className="text-slate-300 font-semibold">Date</TableHead>
                          <TableHead className="text-slate-300 font-semibold">Time</TableHead>
                          <TableHead className="text-slate-300 font-semibold">Location</TableHead>
                          <TableHead className="text-slate-300 font-semibold">Status</TableHead>
                          <TableHead className="text-slate-300 font-semibold">Updated By</TableHead>
                          <TableHead className="text-slate-300 font-semibold">Remarks</TableHead>
                          <TableHead className="text-right text-slate-300 font-semibold">Actions</TableHead>
                        </TableRow>
                      </TableHeader>
                      <TableBody>
                        {shipment.histories.map((history) => (
                          <TableRow key={history.id} className="border-slate-600 hover:bg-slate-700 bg-slate-800">
                            {/* Date Column */}
                            <TableCell className="text-muted-foreground">
                              {new Date(history.created_at).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: '2-digit',
                                day: '2-digit'
                              })}
                            </TableCell>
                            
                            {/* Time Column */}
                            <TableCell className="text-muted-foreground">
                              {new Date(history.created_at).toLocaleTimeString('en-US', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: false
                              })}
                            </TableCell>
                            
                            {/* Location Column */}
                            <TableCell className="text-muted-foreground">
                              {history.location || '-'}
                            </TableCell>
                            
                            {/* Status Column */}
                            <TableCell className="text-muted-foreground">
                              <div className="flex items-center space-x-2">
                                <div className="w-6 h-6 bg-slate-600 rounded-full flex items-center justify-center">
                                  {(() => {
                                    const StatusIcon = getStatusIcon(history.status)
                                    return <StatusIcon className={`h-3 w-3 ${getStatusIconColor(history.status)}`} />
                                  })()}
                                </div>
                                <Badge variant={getStatusBadgeVariant(history.status)} className={getStatusColor(history.status)}>
                                  {history.status.replace('_', ' ').toUpperCase()}
                                </Badge>
                              </div>
                            </TableCell>
                            
                            {/* Updated By Column */}
                            <TableCell className="text-muted-foreground">
                              {history.updated_by || '-'}
                            </TableCell>
                            
                            {/* Remarks Column */}
                            <TableCell className="text-muted-foreground">
                              {history.remarks || '-'}
                            </TableCell>
                            
                            {/* Actions Column */}
                            <TableCell className="text-right">
                              <Button
                                variant="ghost"
                                size="sm"
                                className="text-red-500 hover:text-red-300 hover:bg-slate-600"
                                onClick={() => handleDeleteHistory(history.id)}
                              >
                                <Trash2 className="h-4 w-4" />
                              </Button>
                            </TableCell>
                          </TableRow>
                        ))}
                      </TableBody>
                    </Table>
                  </div>
                ) : (
                  <div className="text-center py-8">
                    <Clock className="h-12 w-12 text-slate-400 mx-auto mb-4" />
                    <p className="text-muted-foreground">No history entries yet</p>
                    <p className="text-slate-500 text-sm">Add the first status update above</p>
                  </div>
                )}
              </div>

            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  )
}
