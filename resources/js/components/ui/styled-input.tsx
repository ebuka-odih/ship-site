import { forwardRef } from 'react'
import { cn } from '@/lib/utils'

export interface StyledInputProps
  extends React.InputHTMLAttributes<HTMLInputElement> {
  hasError?: boolean
}

const StyledInput = forwardRef<HTMLInputElement, StyledInputProps>(
  ({ className, hasError, ...props }, ref) => {
    return (
      <input
        className={cn(
          'flex h-10 w-full rounded-md border border-slate-500 bg-slate-600 px-3 py-2 text-sm text-white placeholder:text-slate-400 focus:border-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400/20 disabled:cursor-not-allowed disabled:opacity-50',
          hasError && 'border-red-500 focus:border-red-500 focus:ring-red-400/20',
          className
        )}
        ref={ref}
        {...props}
      />
    )
  }
)
StyledInput.displayName = 'StyledInput'

export { StyledInput }
