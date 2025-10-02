import { Head, useForm, usePage } from '@inertiajs/react'
import AppLayout from '@/layouts/app-layout'
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
  ExternalLink,
  X
} from 'lucide-react'
import { useState, useCallback, memo } from 'react'

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
  livechat: {
    script: string
  }
}

interface SettingsIndexProps {
  settings: Settings
}

export default function SettingsIndex({ settings }: SettingsIndexProps) {
  const [activeTab, setActiveTab] = useState('general')
  const [testEmail, setTestEmail] = useState('')
  const [showSuccess, setShowSuccess] = useState(false)
  const [showError, setShowError] = useState(false)
  const [message, setMessage] = useState('')
  
  const { flash } = usePage().props as any

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
    mail_encryption: settings.mail.encryption || 'none',
    mail_username: '',
    mail_password: '',
  })

  const { data: testData, setData: setTestData, post: postTest, processing: testProcessing } = useForm({
    test_email: testEmail,
  })

  const { data: livechatData, setData: setLivechatData, post: postLivechat, processing: livechatProcessing } = useForm({
    livechat_script: settings.livechat.script,
  })

  const handleGeneralSubmit = useCallback((e: React.FormEvent) => {
    e.preventDefault()
    postGeneral('/admin/settings/general', {
      onSuccess: () => {
        setMessage('General settings updated successfully!')
        setShowSuccess(true)
        setTimeout(() => setShowSuccess(false), 5000)
      },
      onError: () => {
        setMessage('Failed to update general settings.')
        setShowError(true)
        setTimeout(() => setShowError(false), 5000)
      }
    })
  }, [postGeneral])

  const handleMailSubmit = useCallback((e: React.FormEvent) => {
    e.preventDefault()
    postMail('/admin/settings/mail', {
      onSuccess: () => {
        setMessage('Mail settings updated successfully!')
        setShowSuccess(true)
        setTimeout(() => setShowSuccess(false), 5000)
      },
      onError: () => {
        setMessage('Failed to update mail settings.')
        setShowError(true)
        setTimeout(() => setShowError(false), 5000)
      }
    })
  }, [postMail])

  const handleTestMail = (e: React.FormEvent) => {
    e.preventDefault()
    setTestData('test_email', testEmail)
    postTest('/admin/settings/test-mail')
  }

  const handleLivechatSubmit = useCallback((e: React.FormEvent) => {
    e.preventDefault()
    postLivechat('/admin/settings/livechat', {
      onSuccess: () => {
        setMessage('Livechat settings updated successfully!')
        setShowSuccess(true)
        setTimeout(() => setShowSuccess(false), 5000)
      },
      onError: () => {
        setMessage('Failed to update livechat settings.')
        setShowError(true)
        setTimeout(() => setShowError(false), 5000)
      }
    })
  }, [postLivechat])

  return (
    <AppLayout>
      <Head title="Settings" />
      
      <div className="p-6 space-y-6">
        {/* Header */}
        <div>
          <h1 className="text-3xl font-bold tracking-tight">Settings</h1>
          <p className="text-muted-foreground">Manage system configuration and preferences</p>
        </div>

        {/* Success/Error Messages */}
        {showSuccess && (
          <div className="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
            <div className="flex items-center space-x-2">
              <CheckCircle className="h-5 w-5 text-green-600" />
              <span className="text-green-800 font-medium">{message}</span>
            </div>
            <button
              onClick={() => setShowSuccess(false)}
              className="text-green-600 hover:text-green-800"
            >
              <X className="h-4 w-4" />
            </button>
          </div>
        )}
        
        {showError && (
          <div className="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center justify-between">
            <div className="flex items-center space-x-2">
              <AlertCircle className="h-5 w-5 text-red-600" />
              <span className="text-red-800 font-medium">{message}</span>
            </div>
            <button
              onClick={() => setShowError(false)}
              className="text-red-600 hover:text-red-800"
            >
              <X className="h-4 w-4" />
            </button>
          </div>
        )}

        <Tabs value={activeTab} onValueChange={setActiveTab} className="space-y-6">
          <TabsList className="grid w-full grid-cols-4">
            <TabsTrigger value="general">
              <Building2 className="h-4 w-4 mr-2" />
              General
            </TabsTrigger>
            <TabsTrigger value="mail">
              <Mail className="h-4 w-4 mr-2" />
              Email
            </TabsTrigger>
            <TabsTrigger value="livechat">
              <Globe className="h-4 w-4 mr-2" />
              Livechat
            </TabsTrigger>
            <TabsTrigger value="system">
              <Settings className="h-4 w-4 mr-2" />
              System
            </TabsTrigger>
          </TabsList>

          {/* General Settings */}
          <TabsContent value="general">
            <Card className="p-4">
              <CardHeader className="px-0 pt-0">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Building2 className="h-5 w-5" />
                  <span>Company Information</span>
                </CardTitle>
                <CardDescription className="text-sm">
                  Configure your company details and branding
                </CardDescription>
              </CardHeader>
              <CardContent className="px-0">
                <form onSubmit={handleGeneralSubmit} className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <Label htmlFor="company_name" className="text-sm font-medium">Company Name</Label>
                      <Input
                        id="company_name"
                        type="text"
                        value={generalData.company_name}
                        onChange={(e) => setGeneralData('company_name', e.target.value)}
                        className=""
                        placeholder="Enter company name"
                      />
                    </div>
                    <div>
                      <Label htmlFor="company_email" className="text-sm font-medium">Company Email</Label>
                      <Input
                        id="company_email"
                        type="email"
                        value={generalData.company_email}
                        onChange={(e) => setGeneralData('company_email', e.target.value)}
                        className=""
                        placeholder="Enter company email"
                      />
                    </div>
                  </div>

                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <Label htmlFor="company_phone" className="text-sm font-medium">Phone Number</Label>
                      <Input
                        id="company_phone"
                        type="tel"
                        value={generalData.company_phone}
                        onChange={(e) => setGeneralData('company_phone', e.target.value)}
                        className=""
                        placeholder="Enter phone number"
                      />
                    </div>
                    <div>
                      <Label htmlFor="company_website" className="text-sm font-medium">Website (Optional)</Label>
                      <Input
                        id="company_website"
                        type="text"
                        value={generalData.company_website}
                        onChange={(e) => setGeneralData('company_website', e.target.value)}
                        className=""
                        placeholder="Enter website URL (optional)"
                      />
                    </div>
                  </div>

                  <div>
                    <Label htmlFor="company_address" className="text-sm font-medium">Address</Label>
                    <Textarea
                      id="company_address"
                      value={generalData.company_address}
                      onChange={(e) => setGeneralData('company_address', e.target.value)}
                      className=""
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
              <Card className="p-4">
                <CardHeader className="px-0 pt-0">
                  <CardTitle className="text-base flex items-center space-x-2">
                    <Mail className="h-5 w-5" />
                    <span>Email Configuration</span>
                  </CardTitle>
                  <CardDescription className="text-sm">
                    Configure SMTP settings for sending emails
                  </CardDescription>
                </CardHeader>
                <CardContent className="px-0">
                  <form onSubmit={handleMailSubmit} className="space-y-4">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div>
                        <Label htmlFor="mail_driver" className="text-sm font-medium">Mail Driver</Label>
                        <Select value={mailData.mail_driver} onValueChange={(value) => setMailData('mail_driver', value)}>
                          <SelectTrigger className="">
                            <SelectValue placeholder="Select mail driver" />
                          </SelectTrigger>
                          <SelectContent className="p-4">
                            <SelectItem value="smtp" className="">SMTP</SelectItem>
                            <SelectItem value="mailgun" className="">Mailgun</SelectItem>
                            <SelectItem value="ses" className="">Amazon SES</SelectItem>
                          </SelectContent>
                        </Select>
                      </div>
                      <div>
                        <Label htmlFor="mail_host" className="text-sm font-medium">SMTP Host</Label>
                        <Input
                          id="mail_host"
                          type="text"
                          value={mailData.mail_host}
                          onChange={(e) => setMailData('mail_host', e.target.value)}
                          className=""
                          placeholder="smtp.gmail.com"
                        />
                      </div>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <div>
                        <Label htmlFor="mail_port" className="text-sm font-medium">Port</Label>
                        <Input
                          id="mail_port"
                          type="number"
                          value={mailData.mail_port}
                          onChange={(e) => setMailData('mail_port', parseInt(e.target.value))}
                          className=""
                          placeholder="587"
                        />
                      </div>
                      <div>
                        <Label htmlFor="mail_encryption" className="text-sm font-medium">Encryption</Label>
                        <Select value={mailData.mail_encryption} onValueChange={(value) => setMailData('mail_encryption', value)}>
                          <SelectTrigger className="">
                            <SelectValue placeholder="Select encryption" />
                          </SelectTrigger>
                          <SelectContent className="p-4">
                            <SelectItem value="none" className="">None</SelectItem>
                            <SelectItem value="tls" className="">TLS</SelectItem>
                            <SelectItem value="ssl" className="">SSL</SelectItem>
                          </SelectContent>
                        </Select>
                      </div>
                      <div>
                        <Label htmlFor="mail_username" className="text-sm font-medium">Username</Label>
                        <Input
                          id="mail_username"
                          type="text"
                          value={mailData.mail_username}
                          onChange={(e) => setMailData('mail_username', e.target.value)}
                          className=""
                          placeholder="your-email@gmail.com"
                        />
                      </div>
                    </div>

                    <div>
                      <Label htmlFor="mail_password" className="text-sm font-medium">Password</Label>
                      <Input
                        id="mail_password"
                        type="password"
                        value={mailData.mail_password}
                        onChange={(e) => setMailData('mail_password', e.target.value)}
                        className=""
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
              <Card className="p-4">
                <CardHeader className="px-0 pt-0">
                  <CardTitle className="text-base flex items-center space-x-2">
                    <TestTube className="h-5 w-5" />
                    <span>Test Email Configuration</span>
                  </CardTitle>
                  <CardDescription className="text-sm">
                    Send a test email to verify your configuration
                  </CardDescription>
                </CardHeader>
                <CardContent className="px-0">
                  <form onSubmit={handleTestMail} className="space-y-4">
                    <div>
                      <Label htmlFor="test_email" className="text-sm font-medium">Test Email Address</Label>
                      <Input
                        id="test_email"
                        type="email"
                        value={testEmail}
                        onChange={(e) => setTestEmail(e.target.value)}
                        className=""
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

          {/* Livechat Settings */}
          <TabsContent value="livechat">
            <Card className="p-4">
              <CardHeader className="px-0 pt-0">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Globe className="h-5 w-5" />
                  <span>Livechat Script</span>
                </CardTitle>
                <CardDescription className="text-sm">
                  Add your livechat script to display on the homepage
                </CardDescription>
              </CardHeader>
              <CardContent className="px-0">
                <form onSubmit={handleLivechatSubmit} className="space-y-4">
                  <div className="space-y-2">
                    <Label htmlFor="livechat_script" className="text-sm font-medium">
                      Livechat Script
                    </Label>
                    <Textarea
                      id="livechat_script"
                      value={livechatData.livechat_script}
                      onChange={(e) => setLivechatData('livechat_script', e.target.value)}
                      placeholder="Paste your livechat script here..."
                      className="min-h-32"
                    />
                    <p className="text-xs text-muted-foreground">
                      Paste the complete livechat script code here. It will be included on the homepage.
                    </p>
                  </div>

                  <div className="flex justify-end">
                    <Button 
                      type="submit" 
                      disabled={livechatProcessing}
                      className="flex items-center space-x-2"
                    >
                      <Save className="h-4 w-4" />
                      <span>{livechatProcessing ? 'Saving...' : 'Save Settings'}</span>
                    </Button>
                  </div>
                </form>
              </CardContent>
            </Card>
          </TabsContent>

          {/* System Settings */}
          <TabsContent value="system">
            <Card className="p-4">
              <CardHeader className="px-0 pt-0">
                <CardTitle className="text-base flex items-center space-x-2">
                  <Settings className="h-5 w-5" />
                  <span>System Information</span>
                </CardTitle>
                <CardDescription className="text-sm">
                  View current system configuration
                </CardDescription>
              </CardHeader>
              <CardContent className="px-0">
                <div className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div className="space-y-2">
                      <Label className="text-sm font-medium">Timezone</Label>
                      <div className="flex items-center space-x-2">
                        <Globe className="h-4 w-4 text-slate-400" />
                        <span className="text-sm">{settings.system.timezone}</span>
                      </div>
                    </div>
                    <div className="space-y-2">
                      <Label className="text-sm font-medium">Locale</Label>
                      <div className="flex items-center space-x-2">
                        <Globe className="h-4 w-4 text-slate-400" />
                        <span className="text-sm">{settings.system.locale}</span>
                      </div>
                    </div>
                  </div>

                  <div className="space-y-2">
                    <Label className="text-sm font-medium">Debug Mode</Label>
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
                        <span className="text-sm">Driver: {settings.mail.driver}</span>
                      </div>
                      <div className="flex items-center space-x-2">
                        <Globe className="h-4 w-4 text-slate-400" />
                        <span className="text-sm">Host: {settings.mail.host}</span>
                      </div>
                      <div className="flex items-center space-x-2">
                        <Phone className="h-4 w-4 text-slate-400" />
                        <span className="text-sm">Port: {settings.mail.port}</span>
                      </div>
                      <div className="flex items-center space-x-2">
                        <Settings className="h-4 w-4 text-slate-400" />
                        <span className="text-sm">Encryption: {settings.mail.encryption === 'none' || !settings.mail.encryption ? 'None' : settings.mail.encryption.toUpperCase()}</span>
                      </div>
                    </div>
                  </div>
                </div>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>
      </div>
    </AppLayout>
  )
}
