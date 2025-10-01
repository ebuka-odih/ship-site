import { Head, useForm } from '@inertiajs/react'
import AdminLayout from '@/layouts/AdminLayout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { StyledInput } from '@/components/ui/styled-input'
import { StyledTextarea } from '@/components/ui/styled-textarea'
import { Label } from '@/components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Textarea } from '@/components/ui/textarea'
import { ArrowLeft, Package, MapPin, User, Phone, Mail, Weight, DollarSign } from 'lucide-react'
import { Link } from '@inertiajs/react'

interface User {
  id: number
  name: string
  email: string
}

interface Shipment {
  id: number
  tracking_number: string
  status: string
  origin_address: string
  destination_address: string
  recipient_name: string
  recipient_phone: string
  recipient_email: string | null
  description: string | null
  weight: number | null
  value: number | null
  carrier: string | null
  service_type: string | null
  estimated_delivery: string | null
  actual_delivery: string | null
  notes: string | null
  user_id: number
}

interface EditShipmentProps {
  shipment: Shipment
  users: User[]
}

export default function EditShipment({ shipment, users }: EditShipmentProps) {
  const { data, setData, put, processing, errors } = useForm({
    user_id: shipment.user_id.toString(),
    status: shipment.status,
    origin_address: shipment.origin_address,
    destination_address: shipment.destination_address,
    recipient_name: shipment.recipient_name,
    recipient_phone: shipment.recipient_phone,
    recipient_email: shipment.recipient_email || '',
    description: shipment.description || '',
    weight: shipment.weight?.toString() || '',
    value: shipment.value?.toString() || '',
    carrier: shipment.carrier || '',
    service_type: shipment.service_type || '',
    estimated_delivery: shipment.estimated_delivery ? shipment.estimated_delivery.split(' ')[0] : '',
    actual_delivery: shipment.actual_delivery ? shipment.actual_delivery.split(' ')[0] : '',
    notes: shipment.notes || '',
  })

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    put(`/admin/shipments/${shipment.id}`)
  }

  return (
    <AdminLayout>
      <Head title={`Edit Shipment - ${shipment.tracking_number}`} />
      
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center space-x-4">
          <Button variant="ghost" size="sm" asChild>
            <Link href="/admin/shipments">
              <ArrowLeft className="h-4 w-4" />
            </Link>
          </Button>
          <div>
            <h1 className="text-2xl font-bold text-white">Edit Shipment</h1>
            <p className="text-slate-300">Update shipment information and status</p>
          </div>
        </div>

        <div className="grid gap-6 lg:grid-cols-3">
          {/* Main Form */}
          <div className="lg:col-span-2 space-y-6">
            {/* Customer Selection */}
            <Card className="bg-slate-700 border-slate-600">
              <CardHeader>
                <CardTitle className="text-white flex items-center space-x-2">
                  <User className="h-5 w-5" />
                  <span>Customer Information</span>
                </CardTitle>
                <CardDescription className="text-slate-300">
                  Select the customer for this shipment
                </CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-2">
                  <Label htmlFor="user_id">Customer</Label>
                  <Select value={data.user_id} onValueChange={(value) => setData('user_id', value)}>
                    <SelectTrigger className={errors.user_id ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select a customer" />
                    </SelectTrigger>
                    <SelectContent>
                      {users.map((user) => (
                        <SelectItem key={user.id} value={user.id.toString()}>
                          {user.name} ({user.email})
                        </SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  {errors.user_id && (
                    <p className="text-sm text-red-400">{errors.user_id}</p>
                  )}
                </div>
              </CardContent>
            </Card>

            {/* Status and Route Information */}
            <Card className="bg-slate-700 border-slate-600">
              <CardHeader>
                <CardTitle className="text-white flex items-center space-x-2">
                  <Package className="h-5 w-5" />
                  <span>Status & Route</span>
                </CardTitle>
                <CardDescription className="text-slate-300">
                  Current status and route information
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div className="space-y-2">
                    <Label htmlFor="status">Status</Label>
                    <Select value={data.status} onValueChange={(value) => setData('status', value)}>
                      <SelectTrigger className={errors.status ? 'border-red-500' : ''}>
                        <SelectValue placeholder="Select status" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="pending">Pending</SelectItem>
                        <SelectItem value="in_transit">In Transit</SelectItem>
                        <SelectItem value="delivered">Delivered</SelectItem>
                        <SelectItem value="cancelled">Cancelled</SelectItem>
                      </SelectContent>
                    </Select>
                    {errors.status && (
                      <p className="text-sm text-red-400">{errors.status}</p>
                    )}
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="tracking_number">Tracking Number</Label>
                    <Input
                      id="tracking_number"
                      type="text"
                      value={shipment.tracking_number}
                      disabled
                      className="bg-slate-600 text-slate-400"
                    />
                  </div>
                </div>

                <div className="space-y-2">
                  <Label htmlFor="origin_address">Origin Address</Label>
                  <Input
                    id="origin_address"
                    type="text"
                    value={data.origin_address}
                    onChange={(e) => setData('origin_address', e.target.value)}
                    className={errors.origin_address ? 'border-red-500' : ''}
                    placeholder="Enter origin address"
                  />
                  {errors.origin_address && (
                    <p className="text-sm text-red-400">{errors.origin_address}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="destination_address">Destination Address</Label>
                  <Input
                    id="destination_address"
                    type="text"
                    value={data.destination_address}
                    onChange={(e) => setData('destination_address', e.target.value)}
                    className={errors.destination_address ? 'border-red-500' : ''}
                    placeholder="Enter destination address"
                  />
                  {errors.destination_address && (
                    <p className="text-sm text-red-400">{errors.destination_address}</p>
                  )}
                </div>
              </CardContent>
            </Card>

            {/* Recipient Information */}
            <Card className="bg-slate-700 border-slate-600">
              <CardHeader>
                <CardTitle className="text-white flex items-center space-x-2">
                  <Package className="h-5 w-5" />
                  <span>Recipient Information</span>
                </CardTitle>
                <CardDescription className="text-slate-300">
                  Details about the package recipient
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div className="space-y-2">
                    <Label htmlFor="recipient_name">Recipient Name</Label>
                    <Input
                      id="recipient_name"
                      type="text"
                      value={data.recipient_name}
                      onChange={(e) => setData('recipient_name', e.target.value)}
                      className={errors.recipient_name ? 'border-red-500' : ''}
                      placeholder="Full name"
                    />
                    {errors.recipient_name && (
                      <p className="text-sm text-red-400">{errors.recipient_name}</p>
                    )}
                  </div>

                  <div className="space-y-2">
                    <Label htmlFor="recipient_phone">Phone Number</Label>
                    <Input
                      id="recipient_phone"
                      type="tel"
                      value={data.recipient_phone}
                      onChange={(e) => setData('recipient_phone', e.target.value)}
                      className={errors.recipient_phone ? 'border-red-500' : ''}
                      placeholder="Phone number"
                    />
                    {errors.recipient_phone && (
                      <p className="text-sm text-red-400">{errors.recipient_phone}</p>
                    )}
                  </div>
                </div>

                <div className="space-y-2">
                  <Label htmlFor="recipient_email">Email (Optional)</Label>
                  <Input
                    id="recipient_email"
                    type="email"
                    value={data.recipient_email}
                    onChange={(e) => setData('recipient_email', e.target.value)}
                    className={errors.recipient_email ? 'border-red-500' : ''}
                    placeholder="Email address"
                  />
                  {errors.recipient_email && (
                    <p className="text-sm text-red-400">{errors.recipient_email}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="description">Package Description</Label>
                  <Textarea
                    id="description"
                    value={data.description}
                    onChange={(e) => setData('description', e.target.value)}
                    className={errors.description ? 'border-red-500' : ''}
                    placeholder="Describe the package contents"
                    rows={3}
                  />
                  {errors.description && (
                    <p className="text-sm text-red-400">{errors.description}</p>
                  )}
                </div>
              </CardContent>
            </Card>
          </div>

          {/* Sidebar */}
          <div className="space-y-6">
            {/* Package Details */}
            <Card className="bg-slate-700 border-slate-600">
              <CardHeader>
                <CardTitle className="text-white">Package Details</CardTitle>
                <CardDescription className="text-slate-300">
                  Weight, value, and shipping details
                </CardDescription>
              </CardHeader>
              <CardContent className="space-y-4">
                <div className="space-y-2">
                  <Label htmlFor="weight">Weight (kg)</Label>
                  <Input
                    id="weight"
                    type="number"
                    step="0.01"
                    value={data.weight}
                    onChange={(e) => setData('weight', e.target.value)}
                    className={errors.weight ? 'border-red-500' : ''}
                    placeholder="0.00"
                  />
                  {errors.weight && (
                    <p className="text-sm text-red-400">{errors.weight}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="value">Declared Value</Label>
                  <Input
                    id="value"
                    type="number"
                    step="0.01"
                    value={data.value}
                    onChange={(e) => setData('value', e.target.value)}
                    className={errors.value ? 'border-red-500' : ''}
                    placeholder="0.00"
                  />
                  {errors.value && (
                    <p className="text-sm text-red-400">{errors.value}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="carrier">Carrier</Label>
                  <Input
                    id="carrier"
                    type="text"
                    value={data.carrier}
                    onChange={(e) => setData('carrier', e.target.value)}
                    className={errors.carrier ? 'border-red-500' : ''}
                    placeholder="Shipping company"
                  />
                  {errors.carrier && (
                    <p className="text-sm text-red-400">{errors.carrier}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="service_type">Service Type</Label>
                  <Input
                    id="service_type"
                    type="text"
                    value={data.service_type}
                    onChange={(e) => setData('service_type', e.target.value)}
                    className={errors.service_type ? 'border-red-500' : ''}
                    placeholder="Express, Standard, etc."
                  />
                  {errors.service_type && (
                    <p className="text-sm text-red-400">{errors.service_type}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="estimated_delivery">Estimated Delivery</Label>
                  <Input
                    id="estimated_delivery"
                    type="date"
                    value={data.estimated_delivery}
                    onChange={(e) => setData('estimated_delivery', e.target.value)}
                    className={errors.estimated_delivery ? 'border-red-500' : ''}
                  />
                  {errors.estimated_delivery && (
                    <p className="text-sm text-red-400">{errors.estimated_delivery}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="actual_delivery">Actual Delivery</Label>
                  <Input
                    id="actual_delivery"
                    type="date"
                    value={data.actual_delivery}
                    onChange={(e) => setData('actual_delivery', e.target.value)}
                    className={errors.actual_delivery ? 'border-red-500' : ''}
                  />
                  {errors.actual_delivery && (
                    <p className="text-sm text-red-400">{errors.actual_delivery}</p>
                  )}
                </div>
              </CardContent>
            </Card>

            {/* Additional Notes */}
            <Card className="bg-slate-700 border-slate-600">
              <CardHeader>
                <CardTitle className="text-white">Additional Notes</CardTitle>
                <CardDescription className="text-slate-300">
                  Any special instructions or notes
                </CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-2">
                  <Label htmlFor="notes">Notes</Label>
                  <Textarea
                    id="notes"
                    value={data.notes}
                    onChange={(e) => setData('notes', e.target.value)}
                    className={errors.notes ? 'border-red-500' : ''}
                    placeholder="Special instructions, handling requirements, etc."
                    rows={4}
                  />
                  {errors.notes && (
                    <p className="text-sm text-red-400">{errors.notes}</p>
                  )}
                </div>
              </CardContent>
            </Card>
          </div>
        </div>

        {/* Form Actions */}
        <div className="flex items-center space-x-4">
          <Button type="submit" onClick={handleSubmit} disabled={processing}>
            {processing ? 'Updating...' : 'Update Shipment'}
          </Button>
          <Button variant="outline" asChild>
            <Link href="/admin/shipments">Cancel</Link>
          </Button>
        </div>
      </div>
    </AdminLayout>
  )
}
