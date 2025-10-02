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
import { Plus, Edit, Trash2, Eye } from 'lucide-react'

interface User {
  id: number
  name: string
  email: string
  role: string
  created_at: string
}

interface UsersIndexProps {
  users: {
    data: User[]
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

export default function UsersIndex({ users }: UsersIndexProps) {
  const getRoleBadgeVariant = (role: string) => {
    return role === 'admin' ? 'default' : 'secondary'
  }

  return (
    <AppLayout>
      <Head title="Users Management" />
      
      <div className="space-y-6 p-6">
        {/* Header */}
        <div className="flex items-center justify-between">
          <div>
            <h1 className="text-3xl font-bold tracking-tight">Users</h1>
            <p className="text-muted-foreground">Manage system users and their permissions</p>
          </div>
          <Button asChild>
            <Link href="/admin/users/create">
              <Plus className="mr-2 h-4 w-4" />
              Add User
            </Link>
          </Button>
        </div>

        {/* Users Table */}
        <Card className="p-4">
          <CardHeader className="px-0 pt-0">
            <CardTitle className="text-base">All Users</CardTitle>
            <CardDescription className="text-sm">
              A list of all users in the system with their roles and permissions.
            </CardDescription>
          </CardHeader>
          <CardContent className="px-0 pb-0">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>User</TableHead>
                  <TableHead>Role</TableHead>
                  <TableHead>Created</TableHead>
                  <TableHead className="text-right">Actions</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {users.data.map((user) => (
                  <TableRow key={user.id}>
                    <TableCell>
                      <div className="flex items-center space-x-3">
                        <Avatar className="h-8 w-8">
                          <AvatarImage src="" alt={user.name} />
                          <AvatarFallback>
                            {user.name.split(' ').map(n => n[0]).join('')}
                          </AvatarFallback>
                        </Avatar>
                        <div>
                          <div className="font-medium">{user.name}</div>
                          <div className="text-sm text-muted-foreground">{user.email}</div>
                        </div>
                      </div>
                    </TableCell>
                    <TableCell>
                      <Badge variant={getRoleBadgeVariant(user.role)}>
                        {user.role}
                      </Badge>
                    </TableCell>
                    <TableCell className="text-muted-foreground">
                      {new Date(user.created_at).toLocaleDateString()}
                    </TableCell>
                    <TableCell className="text-right">
                      <div className="flex items-center justify-end space-x-2">
                        <Button variant="ghost" size="sm" asChild>
                          <Link href={`/admin/users/${user.id}`}>
                            <Eye className="h-4 w-4" />
                          </Link>
                        </Button>
                        <Button variant="ghost" size="sm" asChild>
                          <Link href={`/admin/users/${user.id}/edit`}>
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
            {users.links.length > 3 && (
              <div className="flex items-center justify-between mt-4">
                <div className="text-sm text-muted-foreground">
                  Showing {users.meta.per_page * (users.meta.current_page - 1) + 1} to{' '}
                  {Math.min(users.meta.per_page * users.meta.current_page, users.meta.total)} of{' '}
                  {users.meta.total} results
                </div>
                <div className="flex space-x-2">
                  {users.links.map((link, index) => (
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

