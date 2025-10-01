import { forwardRef } from 'react'
import { cn } from '@/lib/utils'

export interface StyledSelectProps
  extends React.SelectHTMLAttributes<HTMLSelectElement> {
  hasError?: boolean
}

const StyledSelect = forwardRef<HTMLSelectElement, StyledSelectProps>(
  ({ className, hasError, children, ...props }, ref) => {
    return (
      <select
        className={cn(
          'flex h-10 w-full rounded-md border border-slate-500 bg-slate-600 px-3 py-2 text-sm text-white focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400/20 disabled:cursor-not-allowed disabled:opacity-50',
          hasError && 'border-red-500 focus:border-red-500 focus:ring-red-400/20',
          className
        )}
        ref={ref}
        {...props}
      >
        {children}
      </select>
    )
  }
)
StyledSelect.displayName = 'StyledSelect'

export { StyledSelect }
