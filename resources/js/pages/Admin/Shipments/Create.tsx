import { Head, useForm } from '@inertiajs/react'
import AppLayout from '@/layouts/app-layout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Textarea } from '@/components/ui/textarea'
import CountrySelect from '@/components/CountrySelect'
import { ArrowLeft, Package, MapPin, Phone, Mail, Weight, DollarSign } from 'lucide-react'
import { Link } from '@inertiajs/react'

export default function CreateShipment() {
  const { data, setData, post, processing, errors } = useForm({
    // Shipper Information
    shipper_name: '',
    shipper_phone: '',
    shipper_address: '',
    shipper_email: '',
    
    // Receiver Information
    receiver_name: '',
    receiver_phone: '',
    receiver_address: '',
    receiver_email: '',
    
    // Shipment Details
    agent_name: '',
    type_of_shipment: '',
    weight: '',
    courier: '',
    packages: '',
    mode: '',
    product: '',
    quantity: '',
    
    // Payment & Freight
    payment_mode: '',
    total_freight: '',
    
    // Carrier Information
    carrier: '',
    carrier_reference_no: '',
    
    // Timing Information
    departure_time: '',
    origin: '',
    destination: '',
    pickup_date: '',
    pickup_time: '',
    expected_delivery_date: '',
    
    // Additional Information
    comments: '',
  })

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    post('/admin/shipments')
  }

  return (
    <AppLayout>
      <Head title="Create Shipment" />
      
      <div className="p-6 space-y-6">
        {/* Header */}
        <div className="flex items-center space-x-4">
          <Button variant="ghost" size="sm" asChild>
            <Link href="/admin/shipments">
              <ArrowLeft className="h-4 w-4" />
            </Link>
          </Button>
          <div>
            <h1 className="text-3xl font-bold tracking-tight">Create Shipment</h1>
            <p className="text-muted-foreground">Add a new shipment to the system</p>
          </div>
        </div>

        <div className="space-y-6">

          {/* Shipper Information */}
          <Card className="p-4">
            <CardHeader className="px-0 pt-0 pb-4">
              <CardTitle className="text-base flex items-center space-x-2">
                <Package className="h-5 w-5 text-green-500" />
                <span>Shipper Information</span>
              </CardTitle>
              <CardDescription className="text-sm">
                Details about the person/company sending the shipment
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="shipper_name" className="text-sm font-medium">Shipper Name</Label>
                  <Input
                    id="shipper_name"
                    type="text"
                    value={data.shipper_name}
                    onChange={(e) => setData('shipper_name', e.target.value)}
                    placeholder="Full name or company name"
                    className={errors.shipper_name ? 'border-red-500' : ''}
                  />
                  {errors.shipper_name && (
                    <p className="text-sm text-red-400">{errors.shipper_name}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="shipper_phone" className="text-sm font-medium">Phone Number</Label>
                  <Input
                    id="shipper_phone"
                    type="tel"
                    value={data.shipper_phone}
                    onChange={(e) => setData('shipper_phone', e.target.value)}
                    className={errors.shipper_phone ? 'border-red-500' : ''}
                    placeholder="Phone number"
                  />
                  {errors.shipper_phone && (
                    <p className="text-sm text-red-400">{errors.shipper_phone}</p>
                  )}
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="shipper_address" className="text-sm font-medium">Address</Label>
                <Textarea
                  id="shipper_address"
                  value={data.shipper_address}
                  onChange={(e) => setData('shipper_address', e.target.value)}
                  className={errors.shipper_address ? 'border-red-500' : ''}
                  placeholder="Complete shipper address"
                  rows={3}
                />
                {errors.shipper_address && (
                  <p className="text-sm text-red-400">{errors.shipper_address}</p>
                )}
              </div>

              <div className="space-y-2">
                <Label htmlFor="shipper_email" className="text-sm font-medium">Email</Label>
                <Input
                  id="shipper_email"
                  type="email"
                  value={data.shipper_email}
                  onChange={(e) => setData('shipper_email', e.target.value)}
                  className={errors.shipper_email ? 'border-red-500' : ''}
                  placeholder="Email address"
                />
                {errors.shipper_email && (
                  <p className="text-sm text-red-400">{errors.shipper_email}</p>
                )}
              </div>
            </CardContent>
          </Card>

          {/* Receiver Information */}
          <Card className="p-4">
            <CardHeader className="px-0 pt-0">
              <CardTitle className="text-base flex items-center space-x-2">
                <MapPin className="h-5 w-5" />
                <span>Receiver Information</span>
              </CardTitle>
              <CardDescription className="text-sm">
                Details about the person/company receiving the shipment
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="receiver_name" className="text-sm font-medium">Receiver Name</Label>
                  <Input
                    id="receiver_name"
                    type="text"
                    value={data.receiver_name}
                    onChange={(e) => setData('receiver_name', e.target.value)}
                    className={errors.receiver_name ? 'border-red-500' : ''}
                    placeholder="Full name or company name"
                  />
                  {errors.receiver_name && (
                    <p className="text-sm text-red-400">{errors.receiver_name}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="receiver_phone" className="text-sm font-medium">Phone Number</Label>
                  <Input
                    id="receiver_phone"
                    type="tel"
                    value={data.receiver_phone}
                    onChange={(e) => setData('receiver_phone', e.target.value)}
                    className={errors.receiver_phone ? 'border-red-500' : ''}
                    placeholder="Phone number"
                  />
                  {errors.receiver_phone && (
                    <p className="text-sm text-red-400">{errors.receiver_phone}</p>
                  )}
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="receiver_address" className="text-sm font-medium">Address</Label>
                <Textarea
                  id="receiver_address"
                  value={data.receiver_address}
                  onChange={(e) => setData('receiver_address', e.target.value)}
                  className={errors.receiver_address ? 'border-red-500' : ''}
                  placeholder="Complete receiver address"
                  rows={3}
                />
                {errors.receiver_address && (
                  <p className="text-sm text-red-400">{errors.receiver_address}</p>
                )}
              </div>

              <div className="space-y-2">
                <Label htmlFor="receiver_email" className="text-sm font-medium">Email</Label>
                <Input
                  id="receiver_email"
                  type="email"
                  value={data.receiver_email}
                  onChange={(e) => setData('receiver_email', e.target.value)}
                  className={errors.receiver_email ? 'border-red-500' : ''}
                  placeholder="Email address"
                />
                {errors.receiver_email && (
                  <p className="text-sm text-red-400">{errors.receiver_email}</p>
                )}
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
              <CardDescription className="text-sm">
                Information about the shipment and package
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="agent_name" className="text-sm font-medium">Agent Name</Label>
                  <Input
                    id="agent_name"
                    type="text"
                    value={data.agent_name}
                    onChange={(e) => setData('agent_name', e.target.value)}
                    className={errors.agent_name ? 'border-red-500' : ''}
                    placeholder="Agent name"
                  />
                  {errors.agent_name && (
                    <p className="text-sm text-red-400">{errors.agent_name}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="type_of_shipment" className="text-sm font-medium">Type of Shipment</Label>
                  <Select value={data.type_of_shipment} onValueChange={(value) => setData('type_of_shipment', value)}>
                    <SelectTrigger className={errors.type_of_shipment ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select type" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="domestic">Domestic</SelectItem>
                      <SelectItem value="international">International</SelectItem>
                      <SelectItem value="express">Express</SelectItem>
                      <SelectItem value="standard">Standard</SelectItem>
                    </SelectContent>
                  </Select>
                  {errors.type_of_shipment && (
                    <p className="text-sm text-red-400">{errors.type_of_shipment}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="weight" className="text-sm font-medium">Weight</Label>
                  <Input
                    id="weight"
                    type="text"
                    value={data.weight}
                    onChange={(e) => setData('weight', e.target.value)}
                    className={errors.weight ? 'border-red-500' : ''}
                    placeholder="Weight with unit (e.g., 5kg)"
                  />
                  {errors.weight && (
                    <p className="text-sm text-red-400">{errors.weight}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="courier" className="text-sm font-medium">Courier</Label>
                  <Input
                    id="courier"
                    type="text"
                    value={data.courier}
                    onChange={(e) => setData('courier', e.target.value)}
                    className={errors.courier ? 'border-red-500' : ''}
                    placeholder="Courier service"
                  />
                  {errors.courier && (
                    <p className="text-sm text-red-400">{errors.courier}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="packages" className="text-sm font-medium">Packages</Label>
                  <Input
                    id="packages"
                    type="text"
                    value={data.packages}
                    onChange={(e) => setData('packages', e.target.value)}
                    className={errors.packages ? 'border-red-500' : ''}
                    placeholder="Number of packages"
                  />
                  {errors.packages && (
                    <p className="text-sm text-red-400">{errors.packages}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="mode" className="text-sm font-medium">Mode</Label>
                  <Select value={data.mode} onValueChange={(value) => setData('mode', value)}>
                    <SelectTrigger className={errors.mode ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select mode" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="air">Air</SelectItem>
                      <SelectItem value="sea">Sea</SelectItem>
                      <SelectItem value="road">Road</SelectItem>
                      <SelectItem value="rail">Rail</SelectItem>
                    </SelectContent>
                  </Select>
                  {errors.mode && (
                    <p className="text-sm text-red-400">{errors.mode}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="product" className="text-sm font-medium">Product</Label>
                  <Input
                    id="product"
                    type="text"
                    value={data.product}
                    onChange={(e) => setData('product', e.target.value)}
                    className={errors.product ? 'border-red-500' : ''}
                    placeholder="Product description"
                  />
                  {errors.product && (
                    <p className="text-sm text-red-400">{errors.product}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="quantity" className="text-sm font-medium">Quantity</Label>
                  <Input
                    id="quantity"
                    type="text"
                    value={data.quantity}
                    onChange={(e) => setData('quantity', e.target.value)}
                    className={errors.quantity ? 'border-red-500' : ''}
                    placeholder="Quantity"
                  />
                  {errors.quantity && (
                    <p className="text-sm text-red-400">{errors.quantity}</p>
                  )}
                </div>
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
              <CardDescription className="text-sm">
                Payment and freight information
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="payment_mode" className="text-sm font-medium">Payment Mode</Label>
                  <Select value={data.payment_mode} onValueChange={(value) => setData('payment_mode', value)}>
                    <SelectTrigger className={errors.payment_mode ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select payment mode" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="cash">Cash</SelectItem>
                      <SelectItem value="credit_card">Credit Card</SelectItem>
                      <SelectItem value="bank_transfer">Bank Transfer</SelectItem>
                      <SelectItem value="check">Check</SelectItem>
                    </SelectContent>
                  </Select>
                  {errors.payment_mode && (
                    <p className="text-sm text-red-400">{errors.payment_mode}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="total_freight" className="text-sm font-medium">Total Freight</Label>
                  <Input
                    id="total_freight"
                    type="text"
                    value={data.total_freight}
                    onChange={(e) => setData('total_freight', e.target.value)}
                    className={errors.total_freight ? 'border-red-500' : ''}
                    placeholder="Total freight amount"
                  />
                  {errors.total_freight && (
                    <p className="text-sm text-red-400">{errors.total_freight}</p>
                  )}
                </div>
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
              <CardDescription className="text-sm">
                Carrier and reference details
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="carrier" className="text-sm font-medium">Carrier</Label>
                  <Select value={data.carrier} onValueChange={(value) => setData('carrier', value)}>
                    <SelectTrigger className={errors.carrier ? 'border-red-500' : ''}>
                      <SelectValue placeholder="Select carrier" />
                    </SelectTrigger>
                    <SelectContent>
                      <SelectItem value="fedex">FedEx</SelectItem>
                      <SelectItem value="ups">UPS</SelectItem>
                      <SelectItem value="dhl">DHL</SelectItem>
                      <SelectItem value="usps">USPS</SelectItem>
                      <SelectItem value="other">Other</SelectItem>
                    </SelectContent>
                  </Select>
                  {errors.carrier && (
                    <p className="text-sm text-red-400">{errors.carrier}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="carrier_reference_no" className="text-sm font-medium">Carrier Reference No.</Label>
                  <Input
                    id="carrier_reference_no"
                    type="text"
                    value={data.carrier_reference_no}
                    onChange={(e) => setData('carrier_reference_no', e.target.value)}
                    className={errors.carrier_reference_no ? 'border-red-500' : ''}
                    placeholder="Carrier reference number"
                  />
                  {errors.carrier_reference_no && (
                    <p className="text-sm text-red-400">{errors.carrier_reference_no}</p>
                  )}
                </div>
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
              <CardDescription className="text-sm">
                Dates, times, and locations
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="origin" className="text-sm font-medium">Origin</Label>
                  <CountrySelect
                    value={data.origin}
                    onValueChange={(value) => setData('origin', value)}
                    placeholder="Select origin country"
                    className={errors.origin ? 'border-red-500' : ''}
                  />
                  {errors.origin && (
                    <p className="text-sm text-red-400">{errors.origin}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="destination" className="text-sm font-medium">Destination</Label>
                  <Input
                    id="destination"
                    type="text"
                    value={data.destination}
                    onChange={(e) => setData('destination', e.target.value)}
                    placeholder="Enter destination"
                    className={errors.destination ? 'border-red-500' : ''}
                  />
                  {errors.destination && (
                    <p className="text-sm text-red-400">{errors.destination}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="pickup_date" className="text-sm font-medium">Pickup Date</Label>
                  <Input
                    id="pickup_date"
                    type="date"
                    value={data.pickup_date}
                    onChange={(e) => setData('pickup_date', e.target.value)}
                    className={errors.pickup_date ? 'border-red-500' : ''}
                  />
                  {errors.pickup_date && (
                    <p className="text-sm text-red-400">{errors.pickup_date}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="pickup_time" className="text-sm font-medium">Pickup Time</Label>
                  <Input
                    id="pickup_time"
                    type="time"
                    value={data.pickup_time}
                    onChange={(e) => setData('pickup_time', e.target.value)}
                    className={errors.pickup_time ? 'border-red-500' : ''}
                  />
                  {errors.pickup_time && (
                    <p className="text-sm text-red-400">{errors.pickup_time}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="departure_time" className="text-sm font-medium">Departure Time</Label>
                  <Input
                    id="departure_time"
                    type="time"
                    value={data.departure_time}
                    onChange={(e) => setData('departure_time', e.target.value)}
                    className={errors.departure_time ? 'border-red-500' : ''}
                  />
                  {errors.departure_time && (
                    <p className="text-sm text-red-400">{errors.departure_time}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="expected_delivery_date" className="text-sm font-medium">Expected Delivery Date</Label>
                  <Input
                    id="expected_delivery_date"
                    type="date"
                    value={data.expected_delivery_date}
                    onChange={(e) => setData('expected_delivery_date', e.target.value)}
                    className={errors.expected_delivery_date ? 'border-red-500' : ''}
                  />
                  {errors.expected_delivery_date && (
                    <p className="text-sm text-red-400">{errors.expected_delivery_date}</p>
                  )}
                </div>
              </div>
            </CardContent>
          </Card>

          {/* Additional Information */}
          <Card className="p-4">
            <CardHeader className="px-0 pt-0 pb-4">
              <CardTitle className="text-base flex items-center space-x-2">
                <Package className="h-5 w-5 text-indigo-500" />
                <span>Additional Information</span>
              </CardTitle>
              <CardDescription className="text-sm">
                Comments and special instructions
              </CardDescription>
            </CardHeader>
            <CardContent>
              <div className="space-y-2">
                <Label htmlFor="comments" className="text-sm font-medium">Comments</Label>
                <Textarea
                  id="comments"
                  value={data.comments}
                  onChange={(e) => setData('comments', e.target.value)}
                  className={errors.comments ? 'border-red-500' : ''}
                  placeholder="Special instructions, handling requirements, etc."
                  rows={4}
                />
                {errors.comments && (
                  <p className="text-sm text-red-400">{errors.comments}</p>
                )}
              </div>
            </CardContent>
          </Card>
        </div>

        {/* Form Actions */}
        <div className="flex items-center space-x-4 pt-6">
          <Button 
            type="submit" 
            onClick={handleSubmit} 
            disabled={processing}
            className="px-6 py-2"
          >
            {processing ? 'Creating...' : 'Create Shipment'}
          </Button>
          <Button 
            variant="outline" 
            asChild
            className=""
          >
            <Link href="/admin/shipments">Cancel</Link>
          </Button>
        </div>
      </div>
    </AppLayout>
  )
}
