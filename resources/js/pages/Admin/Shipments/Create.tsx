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
    <AdminLayout>
      <Head title="Create Shipment" />
      
      <div className="space-y-6">
        {/* Header */}
        <div className="flex items-center space-x-4">
          <Button variant="ghost" size="sm" asChild>
            <Link href="/admin/shipments">
              <ArrowLeft className="h-4 w-4" />
            </Link>
          </Button>
          <div>
            <h1 className="text-2xl font-bold text-white">Create Shipment</h1>
            <p className="text-slate-300">Add a new shipment to the system</p>
          </div>
        </div>

        <div className="space-y-6">

          {/* Shipper Information */}
          <Card className="bg-slate-700 border-slate-600 shadow-lg">
            <CardHeader className="pb-4">
              <CardTitle className="text-white flex items-center space-x-2 text-lg">
                <Package className="h-5 w-5 text-green-400" />
                <span>Shipper Information</span>
              </CardTitle>
              <CardDescription className="text-slate-300">
                Details about the person/company sending the shipment
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="shipper_name" className="text-sm font-medium text-white">Shipper Name</Label>
                  <StyledInput
                    id="shipper_name"
                    type="text"
                    value={data.shipper_name}
                    onChange={(e) => setData('shipper_name', e.target.value)}
                    hasError={!!errors.shipper_name}
                    placeholder="Full name or company name"
                  />
                  {errors.shipper_name && (
                    <p className="text-sm text-red-400">{errors.shipper_name}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="shipper_phone">Phone Number</Label>
                  <StyledInput
                    id="shipper_phone"
                    type="tel"
                    value={data.shipper_phone}
                    onChange={(e) => setData('shipper_phone', e.target.value)}
                    hasError={!!errors.shipper_phone}
                    placeholder="Phone number"
                  />
                  {errors.shipper_phone && (
                    <p className="text-sm text-red-400">{errors.shipper_phone}</p>
                  )}
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="shipper_address">Address</Label>
                <StyledTextarea
                  id="shipper_address"
                  value={data.shipper_address}
                  onChange={(e) => setData('shipper_address', e.target.value)}
                  hasError={!!errors.shipper_address}
                  placeholder="Complete shipper address"
                  rows={3}
                />
                {errors.shipper_address && (
                  <p className="text-sm text-red-400">{errors.shipper_address}</p>
                )}
              </div>

              <div className="space-y-2">
                <Label htmlFor="shipper_email">Email</Label>
                <StyledInput
                  id="shipper_email"
                  type="email"
                  value={data.shipper_email}
                  onChange={(e) => setData('shipper_email', e.target.value)}
                  hasError={!!errors.shipper_email}
                  placeholder="Email address"
                />
                {errors.shipper_email && (
                  <p className="text-sm text-red-400">{errors.shipper_email}</p>
                )}
              </div>
            </CardContent>
          </Card>

          {/* Receiver Information */}
          <Card className="bg-slate-700 border-slate-600">
            <CardHeader>
              <CardTitle className="text-white flex items-center space-x-2">
                <MapPin className="h-5 w-5" />
                <span>Receiver Information</span>
              </CardTitle>
              <CardDescription className="text-slate-300">
                Details about the person/company receiving the shipment
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="receiver_name" className="text-sm font-medium text-white">Receiver Name</Label>
                  <StyledInput
                    id="receiver_name"
                    type="text"
                    value={data.receiver_name}
                    onChange={(e) => setData('receiver_name', e.target.value)}
                    hasError={!!errors.receiver_name}
                    placeholder="Full name or company name"
                  />
                  {errors.receiver_name && (
                    <p className="text-sm text-red-400">{errors.receiver_name}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="receiver_phone" className="text-sm font-medium text-white">Phone Number</Label>
                  <StyledInput
                    id="receiver_phone"
                    type="tel"
                    value={data.receiver_phone}
                    onChange={(e) => setData('receiver_phone', e.target.value)}
                    hasError={!!errors.receiver_phone}
                    placeholder="Phone number"
                  />
                  {errors.receiver_phone && (
                    <p className="text-sm text-red-400">{errors.receiver_phone}</p>
                  )}
                </div>
              </div>

              <div className="space-y-2">
                <Label htmlFor="receiver_address" className="text-sm font-medium text-white">Address</Label>
                <StyledTextarea
                  id="receiver_address"
                  value={data.receiver_address}
                  onChange={(e) => setData('receiver_address', e.target.value)}
                  hasError={!!errors.receiver_address}
                  placeholder="Complete receiver address"
                  rows={3}
                />
                {errors.receiver_address && (
                  <p className="text-sm text-red-400">{errors.receiver_address}</p>
                )}
              </div>

              <div className="space-y-2">
                <Label htmlFor="receiver_email" className="text-sm font-medium text-white">Email</Label>
                <StyledInput
                  id="receiver_email"
                  type="email"
                  value={data.receiver_email}
                  onChange={(e) => setData('receiver_email', e.target.value)}
                  hasError={!!errors.receiver_email}
                  placeholder="Email address"
                />
                {errors.receiver_email && (
                  <p className="text-sm text-red-400">{errors.receiver_email}</p>
                )}
              </div>
            </CardContent>
          </Card>

          {/* Shipment Details */}
          <Card className="bg-slate-700 border-slate-600 shadow-lg">
            <CardHeader className="pb-4">
              <CardTitle className="text-white flex items-center space-x-2 text-lg">
                <Package className="h-5 w-5 text-purple-400" />
                <span>Shipment Details</span>
              </CardTitle>
              <CardDescription className="text-slate-300">
                Information about the shipment and package
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="agent_name" className="text-sm font-medium text-white">Agent Name</Label>
                  <StyledInput
                    id="agent_name"
                    type="text"
                    value={data.agent_name}
                    onChange={(e) => setData('agent_name', e.target.value)}
                    hasError={!!errors.agent_name}
                    placeholder="Agent name"
                  />
                  {errors.agent_name && (
                    <p className="text-sm text-red-400">{errors.agent_name}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="type_of_shipment">Type of Shipment</Label>
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
                  <Label htmlFor="weight" className="text-sm font-medium text-white">Weight</Label>
                  <StyledInput
                    id="weight"
                    type="text"
                    value={data.weight}
                    onChange={(e) => setData('weight', e.target.value)}
                    hasError={!!errors.weight}
                    placeholder="Weight with unit (e.g., 5kg)"
                  />
                  {errors.weight && (
                    <p className="text-sm text-red-400">{errors.weight}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="courier" className="text-sm font-medium text-white">Courier</Label>
                  <StyledInput
                    id="courier"
                    type="text"
                    value={data.courier}
                    onChange={(e) => setData('courier', e.target.value)}
                    hasError={!!errors.courier}
                    placeholder="Courier service"
                  />
                  {errors.courier && (
                    <p className="text-sm text-red-400">{errors.courier}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="packages" className="text-sm font-medium text-white">Packages</Label>
                  <StyledInput
                    id="packages"
                    type="text"
                    value={data.packages}
                    onChange={(e) => setData('packages', e.target.value)}
                    hasError={!!errors.packages}
                    placeholder="Number of packages"
                  />
                  {errors.packages && (
                    <p className="text-sm text-red-400">{errors.packages}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="mode">Mode</Label>
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
                  <Label htmlFor="product" className="text-sm font-medium text-white">Product</Label>
                  <StyledInput
                    id="product"
                    type="text"
                    value={data.product}
                    onChange={(e) => setData('product', e.target.value)}
                    hasError={!!errors.product}
                    placeholder="Product description"
                  />
                  {errors.product && (
                    <p className="text-sm text-red-400">{errors.product}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="quantity" className="text-sm font-medium text-white">Quantity</Label>
                  <StyledInput
                    id="quantity"
                    type="text"
                    value={data.quantity}
                    onChange={(e) => setData('quantity', e.target.value)}
                    hasError={!!errors.quantity}
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
          <Card className="bg-slate-700 border-slate-600 shadow-lg">
            <CardHeader className="pb-4">
              <CardTitle className="text-white flex items-center space-x-2 text-lg">
                <DollarSign className="h-5 w-5 text-yellow-400" />
                <span>Payment & Freight</span>
              </CardTitle>
              <CardDescription className="text-slate-300">
                Payment and freight information
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="payment_mode" className="text-sm font-medium text-white">Payment Mode</Label>
                  <Select value={data.payment_mode} onValueChange={(value) => setData('payment_mode', value)}>
                    <SelectTrigger className={`bg-slate-600 border-slate-500 text-white focus:border-blue-400 focus:ring-blue-400/20 ${errors.payment_mode ? 'border-red-500' : ''}`}>
                      <SelectValue placeholder="Select payment mode" />
                    </SelectTrigger>
                    <SelectContent className="bg-slate-700 border-slate-600">
                      <SelectItem value="cash" className="text-white hover:bg-slate-600 focus:bg-slate-600">Cash</SelectItem>
                      <SelectItem value="credit_card" className="text-white hover:bg-slate-600 focus:bg-slate-600">Credit Card</SelectItem>
                      <SelectItem value="bank_transfer" className="text-white hover:bg-slate-600 focus:bg-slate-600">Bank Transfer</SelectItem>
                      <SelectItem value="check" className="text-white hover:bg-slate-600 focus:bg-slate-600">Check</SelectItem>
                    </SelectContent>
                  </Select>
                  {errors.payment_mode && (
                    <p className="text-sm text-red-400">{errors.payment_mode}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="total_freight" className="text-sm font-medium text-white">Total Freight</Label>
                  <StyledInput
                    id="total_freight"
                    type="text"
                    value={data.total_freight}
                    onChange={(e) => setData('total_freight', e.target.value)}
                    hasError={!!errors.total_freight}
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
          <Card className="bg-slate-700 border-slate-600 shadow-lg">
            <CardHeader className="pb-4">
              <CardTitle className="text-white flex items-center space-x-2 text-lg">
                <Package className="h-5 w-5 text-orange-400" />
                <span>Carrier Information</span>
              </CardTitle>
              <CardDescription className="text-slate-300">
                Carrier and reference details
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="carrier" className="text-sm font-medium text-white">Carrier</Label>
                  <Select value={data.carrier} onValueChange={(value) => setData('carrier', value)}>
                    <SelectTrigger className={`bg-slate-600 border-slate-500 text-white focus:border-blue-400 focus:ring-blue-400/20 ${errors.carrier ? 'border-red-500' : ''}`}>
                      <SelectValue placeholder="Select carrier" />
                    </SelectTrigger>
                    <SelectContent className="bg-slate-700 border-slate-600">
                      <SelectItem value="fedex" className="text-white hover:bg-slate-600 focus:bg-slate-600">FedEx</SelectItem>
                      <SelectItem value="ups" className="text-white hover:bg-slate-600 focus:bg-slate-600">UPS</SelectItem>
                      <SelectItem value="dhl" className="text-white hover:bg-slate-600 focus:bg-slate-600">DHL</SelectItem>
                      <SelectItem value="usps" className="text-white hover:bg-slate-600 focus:bg-slate-600">USPS</SelectItem>
                      <SelectItem value="other" className="text-white hover:bg-slate-600 focus:bg-slate-600">Other</SelectItem>
                    </SelectContent>
                  </Select>
                  {errors.carrier && (
                    <p className="text-sm text-red-400">{errors.carrier}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="carrier_reference_no" className="text-sm font-medium text-white">Carrier Reference No.</Label>
                  <StyledInput
                    id="carrier_reference_no"
                    type="text"
                    value={data.carrier_reference_no}
                    onChange={(e) => setData('carrier_reference_no', e.target.value)}
                    hasError={!!errors.carrier_reference_no}
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
          <Card className="bg-slate-700 border-slate-600 shadow-lg">
            <CardHeader className="pb-4">
              <CardTitle className="text-white flex items-center space-x-2 text-lg">
                <MapPin className="h-5 w-5 text-red-400" />
                <span>Timing Information</span>
              </CardTitle>
              <CardDescription className="text-slate-300">
                Dates, times, and locations
              </CardDescription>
            </CardHeader>
            <CardContent className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="origin" className="text-sm font-medium text-white">Origin</Label>
                  <CountrySelect
                    value={data.origin}
                    onValueChange={(value) => setData('origin', value)}
                    placeholder="Select origin country"
                    hasError={!!errors.origin}
                  />
                  {errors.origin && (
                    <p className="text-sm text-red-400">{errors.origin}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="destination" className="text-sm font-medium text-white">Destination</Label>
                  <CountrySelect
                    value={data.destination}
                    onValueChange={(value) => setData('destination', value)}
                    placeholder="Select destination country"
                    hasError={!!errors.destination}
                  />
                  {errors.destination && (
                    <p className="text-sm text-red-400">{errors.destination}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="pickup_date" className="text-sm font-medium text-white">Pickup Date</Label>
                  <StyledInput
                    id="pickup_date"
                    type="date"
                    value={data.pickup_date}
                    onChange={(e) => setData('pickup_date', e.target.value)}
                    hasError={!!errors.pickup_date}
                  />
                  {errors.pickup_date && (
                    <p className="text-sm text-red-400">{errors.pickup_date}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="pickup_time" className="text-sm font-medium text-white">Pickup Time</Label>
                  <StyledInput
                    id="pickup_time"
                    type="time"
                    value={data.pickup_time}
                    onChange={(e) => setData('pickup_time', e.target.value)}
                    hasError={!!errors.pickup_time}
                  />
                  {errors.pickup_time && (
                    <p className="text-sm text-red-400">{errors.pickup_time}</p>
                  )}
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div className="space-y-2">
                  <Label htmlFor="departure_time" className="text-sm font-medium text-white">Departure Time</Label>
                  <StyledInput
                    id="departure_time"
                    type="time"
                    value={data.departure_time}
                    onChange={(e) => setData('departure_time', e.target.value)}
                    hasError={!!errors.departure_time}
                  />
                  {errors.departure_time && (
                    <p className="text-sm text-red-400">{errors.departure_time}</p>
                  )}
                </div>

                <div className="space-y-2">
                  <Label htmlFor="expected_delivery_date" className="text-sm font-medium text-white">Expected Delivery Date</Label>
                  <StyledInput
                    id="expected_delivery_date"
                    type="date"
                    value={data.expected_delivery_date}
                    onChange={(e) => setData('expected_delivery_date', e.target.value)}
                    hasError={!!errors.expected_delivery_date}
                  />
                  {errors.expected_delivery_date && (
                    <p className="text-sm text-red-400">{errors.expected_delivery_date}</p>
                  )}
                </div>
              </div>
            </CardContent>
          </Card>

          {/* Additional Information */}
          <Card className="bg-slate-700 border-slate-600 shadow-lg">
            <CardHeader className="pb-4">
              <CardTitle className="text-white flex items-center space-x-2 text-lg">
                <Package className="h-5 w-5 text-indigo-400" />
                <span>Additional Information</span>
              </CardTitle>
              <CardDescription className="text-slate-300">
                Comments and special instructions
              </CardDescription>
            </CardHeader>
            <CardContent>
              <div className="space-y-2">
                <Label htmlFor="comments" className="text-sm font-medium text-white">Comments</Label>
                <StyledTextarea
                  id="comments"
                  value={data.comments}
                  onChange={(e) => setData('comments', e.target.value)}
                  hasError={!!errors.comments}
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
            className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 transition-colors disabled:opacity-50"
          >
            {processing ? 'Creating...' : 'Create Shipment'}
          </Button>
          <Button 
            variant="outline" 
            asChild
            className="border-slate-500 text-slate-300 hover:bg-slate-600 hover:text-white transition-colors"
          >
            <Link href="/admin/shipments">Cancel</Link>
          </Button>
        </div>
      </div>
    </AdminLayout>
  )
}
