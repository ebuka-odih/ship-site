import { Head, useForm } from '@inertiajs/react'
import AdminLayout from '@/layouts/AdminLayout'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { Badge } from '@/components/ui/badge'
import { 
  Building2, 
  Mail, 
  Settings, 
  TestTube, 
  Save, 
  CheckCircle, 
  AlertCircle,
  Globe,
  Phone,
  MapPin,
  ExternalLink
} from 'lucide-react'
import { useState } from 'react'

interface Settings {
  company: {
    name: string
    email: string
    phone: string
    address: string
    website: string
  }
  mail: {
    driver: string
    host: string
    port: number
    encryption: string | null
  }
  system: {
    timezone: string
    locale: string
    debug: boolean
  }
}

interface SettingsIndexProps {
  settings: Settings
}

export default function SettingsIndex({ settings }: SettingsIndexProps) {
  const [activeTab, setActiveTab] = useState('general')
  const [testEmail, setTestEmail] = useState('')

  const { data: generalData, setData: setGeneralData, post: postGeneral, processing: generalProcessing } = useForm({
    company_name: settings.company.name,
    company_email: settings.company.email,
    company_phone: settings.company.phone,
    company_address: settings.company.address,
    company_website: settings.company.website,
  })

  const { data: mailData, setData: setMailData, post: postMail, processing: mailProcessing } = useForm({
    mail_driver: settings.mail.driver,
    mail_host: settings.mail.host,
    mail_port: settings.mail.port,
    mail_encryption: settings.mail.encryption || '',
    mail_username: '',
    mail_password: '',
  })

  const { data: testData, setData: setTestData, post: postTest, processing: testProcessing } = useForm({
    test_email: testEmail,
  })

  const handleGeneralSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    postGeneral('/admin/settings/general')
  }

  const handleMailSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    postMail('/admin/settings/mail')
  }

  const handleTestMail = (e: React.FormEvent) => {
    e.preventDefault()
    setTestData('test_email', testEmail)
    postTest('/admin/settings/test-mail')
  }

  return (
    <AdminLayout>
      <Head title="Settings" />
      
      <div className="space-y-6">
        {/* Header */}
        <div>
          <h1 className="text-2xl font-bold text-white">Settings</h1>
          <p className="text-slate-300">Manage system configuration and preferences</p>
        </div>

        <Tabs value={activeTab} onValueChange={setActiveTab} className="space-y-6">
          <TabsList className="grid w-full grid-cols-3 bg-slate-800 border-slate-600">
            <TabsTrigger value="general" className="data-[state=active]:bg-slate-700 data-[state=active]:text-white">
              <Building2 className="h-4 w-4 mr-2" />
              General
            </TabsTrigger>
            <TabsTrigger value="mail" className="data-[state=active]:bg-slate-700 data-[state=active]:text-white">
              <Mail className="h-4 w-4 mr-2" />
              Email
            </TabsTrigger>
            <TabsTrigger value="system" className="data-[state=active]:bg-slate-700 data-[state=active]:text-white">
              <Settings className="h-4 w-4 mr-2" />
              System
            </TabsTrigger>
          </TabsList>

          {/* General Settings */}
          <TabsContent value="general">
            <Card className="bg-slate-700 border-slate-600">
              <CardHeader>
                <CardTitle className="text-white flex items-center space-x-2">
                  <Building2 className="h-5 w-5" />
                  <span>Company Information</span>
                </CardTitle>
                <CardDescription className="text-slate-300">
                  Configure your company details and branding
                </CardDescription>
              </CardHeader>
              <CardContent>
                <form onSubmit={handleGeneralSubmit} className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <Label htmlFor="company_name" className="text-sm font-medium text-white">Company Name</Label>
                      <Input
                        id="company_name"
                        type="text"
                        value={generalData.company_name}
                        onChange={(e) => setGeneralData('company_name', e.target.value)}
                        className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                        placeholder="Enter company name"
                      />
                    </div>
                    <div>
                      <Label htmlFor="company_email" className="text-sm font-medium text-white">Company Email</Label>
                      <Input
                        id="company_email"
                        type="email"
                        value={generalData.company_email}
                        onChange={(e) => setGeneralData('company_email', e.target.value)}
                        className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                        placeholder="Enter company email"
                      />
                    </div>
                  </div>

                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <Label htmlFor="company_phone" className="text-sm font-medium text-white">Phone Number</Label>
                      <Input
                        id="company_phone"
                        type="tel"
                        value={generalData.company_phone}
                        onChange={(e) => setGeneralData('company_phone', e.target.value)}
                        className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                        placeholder="Enter phone number"
                      />
                    </div>
                    <div>
                      <Label htmlFor="company_website" className="text-sm font-medium text-white">Website</Label>
                      <Input
                        id="company_website"
                        type="url"
                        value={generalData.company_website}
                        onChange={(e) => setGeneralData('company_website', e.target.value)}
                        className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                        placeholder="Enter website URL"
                      />
                    </div>
                  </div>

                  <div>
                    <Label htmlFor="company_address" className="text-sm font-medium text-white">Address</Label>
                    <Textarea
                      id="company_address"
                      value={generalData.company_address}
                      onChange={(e) => setGeneralData('company_address', e.target.value)}
                      className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                      placeholder="Enter company address"
                      rows={3}
                    />
                  </div>

                  <div className="flex justify-end">
                    <Button 
                      type="submit" 
                      disabled={generalProcessing}
                      className="bg-blue-600 hover:bg-blue-700 text-white"
                    >
                      <Save className="h-4 w-4 mr-2" />
                      {generalProcessing ? 'Saving...' : 'Save General Settings'}
                    </Button>
                  </div>
                </form>
              </CardContent>
            </Card>
          </TabsContent>

          {/* Mail Settings */}
          <TabsContent value="mail">
            <div className="space-y-6">
              <Card className="bg-slate-700 border-slate-600">
                <CardHeader>
                  <CardTitle className="text-white flex items-center space-x-2">
                    <Mail className="h-5 w-5" />
                    <span>Email Configuration</span>
                  </CardTitle>
                  <CardDescription className="text-slate-300">
                    Configure SMTP settings for sending emails
                  </CardDescription>
                </CardHeader>
                <CardContent>
                  <form onSubmit={handleMailSubmit} className="space-y-4">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <Label htmlFor="mail_driver" className="text-sm font-medium text-white">Mail Driver</Label>
                        <Select value={mailData.mail_driver} onValueChange={(value) => setMailData('mail_driver', value)}>
                          <SelectTrigger className="bg-slate-600 border-slate-500 text-white">
                            <SelectValue placeholder="Select mail driver" />
                          </SelectTrigger>
                          <SelectContent className="bg-slate-700 border-slate-600">
                            <SelectItem value="smtp" className="text-white">SMTP</SelectItem>
                            <SelectItem value="mailgun" className="text-white">Mailgun</SelectItem>
                            <SelectItem value="ses" className="text-white">Amazon SES</SelectItem>
                          </SelectContent>
                        </Select>
                      </div>
                      <div>
                        <Label htmlFor="mail_host" className="text-sm font-medium text-white">SMTP Host</Label>
                        <Input
                          id="mail_host"
                          type="text"
                          value={mailData.mail_host}
                          onChange={(e) => setMailData('mail_host', e.target.value)}
                          className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                          placeholder="smtp.gmail.com"
                        />
                      </div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <div>
                        <Label htmlFor="mail_port" className="text-sm font-medium text-white">Port</Label>
                        <Input
                          id="mail_port"
                          type="number"
                          value={mailData.mail_port}
                          onChange={(e) => setMailData('mail_port', parseInt(e.target.value))}
                          className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                          placeholder="587"
                        />
                      </div>
                      <div>
                        <Label htmlFor="mail_encryption" className="text-sm font-medium text-white">Encryption</Label>
                        <Select value={mailData.mail_encryption} onValueChange={(value) => setMailData('mail_encryption', value)}>
                          <SelectTrigger className="bg-slate-600 border-slate-500 text-white">
                            <SelectValue placeholder="Select encryption" />
                          </SelectTrigger>
                          <SelectContent className="bg-slate-700 border-slate-600">
                            <SelectItem value="" className="text-white">None</SelectItem>
                            <SelectItem value="tls" className="text-white">TLS</SelectItem>
                            <SelectItem value="ssl" className="text-white">SSL</SelectItem>
                          </SelectContent>
                        </Select>
                      </div>
                      <div>
                        <Label htmlFor="mail_username" className="text-sm font-medium text-white">Username</Label>
                        <Input
                          id="mail_username"
                          type="text"
                          value={mailData.mail_username}
                          onChange={(e) => setMailData('mail_username', e.target.value)}
                          className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                          placeholder="your-email@gmail.com"
                        />
                      </div>
                    </div>

                    <div>
                      <Label htmlFor="mail_password" className="text-sm font-medium text-white">Password</Label>
                      <Input
                        id="mail_password"
                        type="password"
                        value={mailData.mail_password}
                        onChange={(e) => setMailData('mail_password', e.target.value)}
                        className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                        placeholder="Enter SMTP password"
                      />
                    </div>

                    <div className="flex justify-end">
                      <Button 
                        type="submit" 
                        disabled={mailProcessing}
                        className="bg-blue-600 hover:bg-blue-700 text-white"
                      >
                        <Save className="h-4 w-4 mr-2" />
                        {mailProcessing ? 'Saving...' : 'Save Mail Settings'}
                      </Button>
                    </div>
                  </form>
                </CardContent>
              </Card>

              {/* Test Email */}
              <Card className="bg-slate-700 border-slate-600">
                <CardHeader>
                  <CardTitle className="text-white flex items-center space-x-2">
                    <TestTube className="h-5 w-5" />
                    <span>Test Email Configuration</span>
                  </CardTitle>
                  <CardDescription className="text-slate-300">
                    Send a test email to verify your configuration
                  </CardDescription>
                </CardHeader>
                <CardContent>
                  <form onSubmit={handleTestMail} className="space-y-4">
                    <div>
                      <Label htmlFor="test_email" className="text-sm font-medium text-white">Test Email Address</Label>
                      <Input
                        id="test_email"
                        type="email"
                        value={testEmail}
                        onChange={(e) => setTestEmail(e.target.value)}
                        className="bg-slate-600 border-slate-500 text-white placeholder:text-slate-400"
                        placeholder="test@example.com"
                      />
                    </div>
                    <div className="flex justify-end">
                      <Button 
                        type="submit" 
                        disabled={testProcessing}
                        className="bg-green-600 hover:bg-green-700 text-white"
                      >
                        <TestTube className="h-4 w-4 mr-2" />
                        {testProcessing ? 'Sending...' : 'Send Test Email'}
                      </Button>
                    </div>
                  </form>
                </CardContent>
              </Card>
            </div>
          </TabsContent>

          {/* System Settings */}
          <TabsContent value="system">
            <Card className="bg-slate-700 border-slate-600">
              <CardHeader>
                <CardTitle className="text-white flex items-center space-x-2">
                  <Settings className="h-5 w-5" />
                  <span>System Information</span>
                </CardTitle>
                <CardDescription className="text-slate-300">
                  View current system configuration
                </CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-2">
                      <Label className="text-sm font-medium text-white">Timezone</Label>
                      <div className="flex items-center space-x-2">
                        <Globe className="h-4 w-4 text-slate-400" />
                        <span className="text-slate-300">{settings.system.timezone}</span>
                      </div>
                    </div>
                    <div className="space-y-2">
                      <Label className="text-sm font-medium text-white">Locale</Label>
                      <div className="flex items-center space-x-2">
                        <Globe className="h-4 w-4 text-slate-400" />
                        <span className="text-slate-300">{settings.system.locale}</span>
                      </div>
                    </div>
                  </div>

                  <div className="space-y-2">
                    <Label className="text-sm font-medium text-white">Debug Mode</Label>
                    <div className="flex items-center space-x-2">
                      {settings.system.debug ? (
                        <>
                          <AlertCircle className="h-4 w-4 text-yellow-400" />
                          <Badge variant="outline" className="border-yellow-400 text-yellow-400">Enabled</Badge>
                        </>
                      ) : (
                        <>
                          <CheckCircle className="h-4 w-4 text-green-400" />
                          <Badge variant="outline" className="border-green-400 text-green-400">Disabled</Badge>
                        </>
                      )}
                    </div>
                  </div>

                  <div className="pt-4 border-t border-slate-600">
                    <h4 className="text-white font-medium mb-2">Current Mail Configuration</h4>
                    <div className="space-y-2 text-sm">
                      <div className="flex items-center space-x-2">
                        <Mail className="h-4 w-4 text-slate-400" />
                        <span className="text-slate-300">Driver: {settings.mail.driver}</span>
                      </div>
                      <div className="flex items-center space-x-2">
                        <Globe className="h-4 w-4 text-slate-400" />
                        <span className="text-slate-300">Host: {settings.mail.host}</span>
                      </div>
                      <div className="flex items-center space-x-2">
                        <Phone className="h-4 w-4 text-slate-400" />
                        <span className="text-slate-300">Port: {settings.mail.port}</span>
                      </div>
                      <div className="flex items-center space-x-2">
                        <Settings className="h-4 w-4 text-slate-400" />
                        <span className="text-slate-300">Encryption: {settings.mail.encryption || 'None'}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>
      </div>
    </AdminLayout>
  )
}
